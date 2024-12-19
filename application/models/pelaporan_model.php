<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelaporan_model extends CI_Model
{
    // Fungsi untuk menyimpan data pelaporan
    public function simpanPelaporan($data)
    {
        return $this->db->insert('pelaporan', $data);
    }

    public function countByStatus($status)
    {
        $this->db->where('status', $status);
        $this->db->from('pelaporan');
        return $this->db->count_all_results();
    }

    public function getAllPelaporan()
    {
        return $this->db->get('pelaporan')->result_array();
    }

    public function get_nama_file_gambar($id)
    {
        $this->db->select('id', $id);
        $this->db->from('laporan');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->$id;
        }
        return false;
    }

    public function getMonthlyReport()
    {
        $this->db->select("MONTH(tanggal) as bulan, COUNT(id) as jumlah");
        $this->db->from("pelaporan");
        $this->db->group_by("MONTH(tanggal)");
        $this->db->order_by("bulan", "ASC");

        return $this->db->get()->result_array();
    }

    public function getKotaEnumValues()
    {
        $query = $this->db->query("
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = 'pelaporan' 
            AND COLUMN_NAME = 'kota'
        ");

        $result = $query->row();
        if ($result) {
            $enum_values = $result->COLUMN_TYPE;
            // Clean the enum values
            $enum_values = str_replace("enum(", "", $enum_values);
            $enum_values = str_replace(")", "", $enum_values);
            $enum_values = str_replace("'", "", $enum_values);
            return explode(",", $enum_values);
        }
        return [];
    }

    public function getDamageByCity()
    {
        $this->db->select('kota, COUNT(id) as jumlah');
        $this->db->from('pelaporan');
        $this->db->group_by('kota');
        $this->db->order_by('jumlah', 'DESC');

        return $this->db->get()->result_array();
    }

    public function countAllPelaporan()
    {
        return $this->db->count_all('pelaporan'); // Ganti 'pelaporan' dengan nama tabel Anda
    }

    public function hitungStatusDalamPenanganan() {
        $this->db->where('status', 'Dalam Penanganan');
        $this->db->from('pelaporan');
        return $this->db->count_all_results();
    }

    public function hitungStatusSelesai() {
        $this->db->where('status', 'Selesai');
        $this->db->from('pelaporan');
        return $this->db->count_all_results();
    }

    public function getJumlahStatusPelaporan() {
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('pelaporan');
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }

}
