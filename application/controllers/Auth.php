<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'id' => $user['id'],

                    ];
                    $this->session->set_userdata($data);

                    if ($user['id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Password anda salah </div>');
                    redirect(base_url('auth'));
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                Email anda salah, Anda belum mendaftar </div>');
                redirect(base_url('auth'));
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password1', 'Password1', 'required|min_length[6]|matches[password2]|trim');
        $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password1]|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/register');
        } else {
            $last_id = $this->db->select('id')
                ->order_by('id', 'DESC')
                ->limit(1)
                ->get('user')
                ->row_array();

            // Tentukan ID baru
            if ($last_id) {
                $id = $last_id['id'] + 1;
                if ($id == 1) { // Jika id adalah 1, loncati ke 2
                    $id++;
                }
            } else {
                $id = 2; // Jika tabel kosong, mulai dari 2
            }

            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id'       => $id,
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
                Selamat, anda sudah terdaftar! Silahkan login </div>');
            redirect(base_url('auth'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">
            Anda sudah keluar</div>');
        redirect(base_url('auth'));
    }
}
