<?php
defined('BASEPATH') or exit('No direct script access allowed');

    class Pemeliharaan_model extends CI_Model
{
    public function getPemeliharaanData() {
        $query = $this->db->get('pemeliharaan'); // Pastikan tabel "testis" ada di database Anda
        return $query->result_array(); // Mengembalikan data sebagai array
    }

    public function getAllPemeliharaan()
    {
        return $this->db->get('pemeliharaan')->result_array(); // Ambil semua data dari tabel 'pemeliharaan'
    }




}


