<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelaporan_model'); // Load model pelaporan
        $this->load->library('form_validation'); // Load form validation
        $this->load->library('session'); // Memuat session
        $this->load->database(); // Memuat database
    }

    public function updateStatusInAction()
    {
        $id = $this->input->post('id');

        // Additional data to update
        $updateData = array(
            'status' => 'Dalam Penanganan'
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

    public function updateStatusInConfirmation()
    {
        $id = $this->input->post('id');

        // Additional data to update
        $updateData = array(
            'status' => 'Menunggu Konfirmasi'
        );

        $this->db->where('id', $id);
        $result = $this->db->update('pelaporan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Dalam Penanganan".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('user/perbaikan');
    }

    public function updateStatusFinish()
    {
        $id = $this->input->post('id');

        // Additional data to update
        $updateData = array(
            'status' => 'Selesai'
        );

        $this->db->where('id', $id);
        $result = $this->db->update('pelaporan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Selesai".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('user/perbaikan');
    }

    public function updateStatusAction()
    {
        $no_regis = $this->input->post('no_regis');

        // Additional data to update
        $updateData = array(
            'status' => 'Dalam Penanganan'
        );

        $this->db->where('no_regis', $no_regis);
        $result = $this->db->update('pemeliharaan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Dalam Penanganan".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('user/report');
    }

    public function updateStatusConfirmation()
    {
        $no_regis = $this->input->post('no_regis');

        // Additional data to update
        $updateData = array(
            'status' => 'Menunggu Konfirmasi'
        );

        $this->db->where('no_regis', $no_regis);
        $result = $this->db->update('pemeliharaan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Dalam Penanganan".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('admin/report');
    }

    public function updateStatusSelesai()
    {
        $no_regis = $this->input->post('no_regis');

        // Additional data to update
        $updateData = array(
            'status' => 'Selesai'
        );

        $this->db->where('no_regis', $no_regis);
        $result = $this->db->update('pemeliharaan', $updateData);

        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Selesai".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        redirect('user/report');
    }
}
