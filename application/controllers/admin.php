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

        // Total Kejadian
        $totalKejadian = $this->db->count_all('pelaporan');

        // Kejadian dalam penanganan
        $dalamPenanganan = $this->db->where('status', 'Dalam Penanganan')
            ->count_all_results('pelaporan');

        // Kejadian selesai
        $kejadianSelesai = $this->db->where('status', 'Selesai')
            ->count_all_results('pelaporan');

        // Data untuk status
        $status = [
            'totalKejadian' => $totalKejadian,
            'dalamPenanganan' => $dalamPenanganan,
            'kejadianSelesai' => $kejadianSelesai,
        ];

        $monthlyReportData = $this->Pelaporan_model->getMonthlyReport();

        $data['chartData'] = $this->prepareMonthlyData($monthlyReportData);

        $cityReportData = $this->Pelaporan_model->getDamageByCity();
        $data['cityChartData'] = [
            'labels' => array_column($cityReportData, 'kota'),
            'data' => array_column($cityReportData, 'jumlah'),
        ];

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

        $data = array_merge($data, $status,);
        $this->load->view('admin/index', $data);
    }

    public function getDamagesByCity()
    {
        $this->db->select('kota, COUNT(id) as jumlah_kerusakan');
        $this->db->group_by('kota'); // Mengelompokkan berdasarkan kota
        $query = $this->db->get('pelaporan'); // Mengambil data dari tabel 'pelaporan'
        return $query->result_array();
    }

    private function prepareMonthlyData($monthlyReportData)
    {
        $monthlyData = array_fill(1, 12, 0); // Inisialisasi bulan (1-12) dengan nilai 0

        foreach ($monthlyReportData as $row) {
            $monthlyData[(int) $row['bulan']] = (int) $row['jumlah'];
        }

        return [
            'labels' => [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            'data' => array_values($monthlyData),
        ];
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

    public function report()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();

        $this->load->model('pemeliharaan_model'); // Pastikan model dimuat
        $data['pemeliharaan'] = $this->pemeliharaan_model->getPemeliharaanData();

        // Untuk menampilkan data di halaman
        $this->load->view('admin/report', array_merge($data, $viewData));
    }

    public function updateStatusAction()
    {
        // Validasi input
        $no_regis = $this->input->post('no_regis');

        if (!$no_regis) {
            $this->session->set_flashdata('message', 'Nomor registrasi tidak ditemukan.');
            redirect('admin/report');
            return;
        }

        // Data yang akan diupdate
        $updateData = array(
            'status' => 'Dalam Penanganan',
            'updated_at' => date('Y-m-d H:i:s'), // Timestamp
            'updated_by' => $this->session->userdata('user_id') // ID pengguna yang sedang login
        );

        // Update status berdasarkan no_regis
        $this->db->where('no_regis', $no_regis);
        $result = $this->db->update('pelaporan', $updateData);

        // Cek apakah update berhasil atau gagal
        if ($result) {
            $this->session->set_flashdata('message', 'Status berhasil diperbarui menjadi "Dalam Penanganan".');
        } else {
            $this->session->set_flashdata('message', 'Gagal memperbarui status.');
        }

        // Redirect ke halaman laporan
        redirect('admin/report');
    }
}
