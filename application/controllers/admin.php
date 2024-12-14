<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelaporan_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();

        $this->load->model('Pelaporan_model');

        // Data untuk Pie Chart Kerusakan
        $data['kerusakan'] = [
            'Butuh Penanganan' => $this->Pelaporan_model->countByStatus('Butuh Penanganan'),
            'Dalam Penanganan' => $this->Pelaporan_model->countByStatus('Dalam Penanganan'),
            'Selesai' => $this->Pelaporan_model->countByStatus('Selesai'),
        ];

        // Data untuk Pie Chart Perbaikan
        $data['perbaikan'] = [
            'Selesai' => $this->Pelaporan_model->countByStatus('Selesai'),
            'Belum Selesai' => $this->Pelaporan_model->countByStatus('Butuh Penanganan') + $this->Pelaporan_model->countByStatus('Dalam Penanganan'),
        ];

        // Kirim Data untuk Frontend
        $this->load->view('admin/index', $data);
    }

    public function pelaporan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();

        // Untuk request AJAX (misalnya dari DataTables)
        if ($this->input->is_ajax_request()) {
            echo json_encode(['data' => $viewData['pelaporan']]);
            return;
        }

        // Untuk menampilkan data di halaman
        $this->load->view('admin/pelaporan', array_merge($data, $viewData));
    }

    public function perbaikan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();

        // Untuk request AJAX (misalnya dari DataTables)
        if ($this->input->is_ajax_request()) {
            echo json_encode(['data' => $viewData['pelaporan']]);
            return;
        }

        // Untuk menampilkan data di halaman
        $this->load->view('admin/perbaikan', array_merge($data, $viewData));
    }

    public function updateStatusInAction()
    {
        $id = $this->input->post('id');

        // Additional data to update
        $updateData = array(
            'status' => 'Dalam Penanganan',
            'updated_at' => date('Y-m-d H:i:s'), // Timestamp
            'updated_by' => $this->session->userdata('user_id') // Example of logged-in user ID
        );

        $this->db->where('id', $id);
        $result = $this->db->update('pelaporan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Dalam Penanganan".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('admin/perbaikan');
    }
}
