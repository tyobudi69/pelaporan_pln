<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelaporan_model'); // Load model pelaporan
        $this->load->library('form_validation'); // Load form validation
        $this->load->library('session'); // Memuat session
        $this->load->database(); // Memuat database
    }

    public function index()
    {
        // Ambil data user berdasarkan sesi login
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();

        $this->load->model('Pelaporan_model');

        $totalKejadian = $this->db->count_all('pelaporan');

        // Kejadian dalam penanganan
        $dalamPenanganan = $this->db->where('status', 'Dalam Penanganan')
            ->count_all_results('pelaporan');

        // Kejadian selesai
        $kejadianSelesai = $this->db->where('status', 'Selesai')
            ->count_all_results('pelaporan');

        // Kirim data ke view
        $status = [
            'totalKejadian' => $totalKejadian,
            'dalamPenanganan' => $dalamPenanganan,
            'kejadianSelesai' => $kejadianSelesai
        ];

        // Ambil data jumlah kerusakan per bulan dari model
        $monthlyReportData = $this->Pelaporan_model->getMonthlyReport();

        $cityReportData = $this->Pelaporan_model->getDamageByCity();
        $data['cityChartData'] = [
            'labels' => array_column($cityReportData, 'kota'),
            'data' => array_column($cityReportData, 'jumlah'),
        ];

        // Siapkan data untuk Bar Chart
        $data['chartData'] = $this->prepareMonthlyData($monthlyReportData);

        // Data untuk Pie Chart Kerusakan
        $data['kerusakan'] = [
            'Butuh Penanganan' => $this->Pelaporan_model->countByStatus('Butuh Penanganan'),
            'Dalam Penanganan' => $this->Pelaporan_model->countByStatus('Dalam Penanganan'),
            'Selesai' => $this->Pelaporan_model->countByStatus('Selesai'),
        ];

        $viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();



        // Untuk request AJAX (misalnya dari DataTables)
        if ($this->input->is_ajax_request()) {
            echo json_encode(['data' => $viewData['pelaporan']]);
            return;
        }

        // Untuk menampilkan data di halaman
        $this->load->view('user/index', array_merge($data, $viewData, $status));
    }

    /**
     * Menyiapkan data bulanan untuk digunakan dalam Bar Chart
     */
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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();

        $data['kota_options'] = $this->Pelaporan_model->getKotaEnumValues();


        // Cek apakah form disubmit
        if ($this->input->post()) {
            // Validasi form
            $this->form_validation->set_rules('alamat', 'Alamat Lokasi Kejadian', 'required');
            $this->form_validation->set_rules('jenis_kesalahan', 'Jenis Kesalahan', 'required');
            $this->form_validation->set_rules('jenis_tindakan', 'Jenis Tindakan', 'required');
            $this->form_validation->set_rules('kota', 'Kota/Kabupaten', 'required'); // Add validation for kota

            if ($this->form_validation->run() == TRUE) {
                // Ambil data dari form
                $alamat = $this->input->post('alamat');
                $jenis_kesalahan = $this->input->post('jenis_kesalahan');
                $jenis_tindakan = $this->input->post('jenis_tindakan');
                $kota = $this->input->post('kota'); // Add kota from form input
                $gambar = '';

                // Proses upload file gambar
                if (!empty($_FILES['photo']['name'])) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2048; // Maksimal 2MB
                    $config['file_name'] = time() . '_' . $_FILES['photo']['name'];

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('photo')) {
                        $uploadData = $this->upload->data();
                        $gambar = 'uploads/' . $uploadData['file_name'];
                    } else {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('user/pelaporan', $data);
                        return;
                    }
                }

                // Simpan data ke database
                $data['username'] = $data['user']['username']; // Ambil username dari data user

                $data_pelaporan = [
                    'kota' => $kota,
                    'lokasi' => $alamat,
                    'jenis_kesalahan' => $jenis_kesalahan,
                    'jenis_tindakan' => $jenis_tindakan,
                    'gambar' => $gambar,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'username' => $data['username']
                ];

                $this->Pelaporan_model->simpanPelaporan($data_pelaporan);

                // Redirect ke halaman lain dengan pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success">Laporan berhasil dikirim!</div>');
                redirect('user/pelaporan');
            }
        }

        $this->load->view('user/pelaporan', $data);
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
        $this->load->view('user/perbaikan', array_merge($data, $viewData));
    }

    public function get_image($id)
    {
        $this->load->model('Pelaporan_model');
        $laporan = $this->Pelaporan_model->getLaporanById($id);

        if ($laporan && file_exists('./uploads/' . $laporan['gambar'])) {
            $file = './uploads/' . $laporan['gambar'];
            header('Content-Type: ' . mime_content_type($file));
            readfile($file);
            exit;
        } else {
            show_404();
        }
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

        redirect('user/perbaikan');
    }

    public function updateStatusFinish()
    {
        $id = $this->input->post('id');

        // Additional data to update
        $updateData = array(
            'status' => 'Selesai',
            'updated_at' => date('Y-m-d H:i:s'), // Timestamp
            'updated_by' => $this->session->userdata('user_id') // Example of logged-in user ID
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
    public function getDamagesByCity()
    {
        $this->db->select('kota, COUNT(id) as jumlah_kerusakan');
        $this->db->group_by('kota'); // Mengelompokkan berdasarkan kota
        $query = $this->db->get('pelaporan'); // Mengambil data dari tabel 'pelaporan'
        return $query->result_array();
    }

    public function dashboard()
    {
        // Ambil data user dari session
        $viewData['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Hitung jumlah pelaporan dari database
        $viewData['jumlah_pelaporan'] = $this->Pelaporan_model->countAllPelaporan();
        $viewData['dalam_penanganan'] = $this->Pelaporan_model->countByStatus('Dalam Penanganan');
        $viewData['selesai'] = $this->Pelaporan_model->countByStatus('Selesai');

        // Kirim data ke view
        $this->load->view('user/dashboard', $viewData);
    }

    public function pemeliharaan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();

                $this->load->model('pemeliharaan_model'); // Pastikan model dimuat
                $data['pemeliharaan'] = $this->pemeliharaan_model->getPemeliharaanData(); // Ambil data dari model
                
    
            // Untuk menampilkan data di halaman
            $this->load->view('user/pemeliharaan', array_merge($data));
    }

    public function update_pemeliharaan()
    {
        $no_regis = $this->input->post('no_regis');
        $jenis_kesalahan = $this->input->post('jenis_kesalahan');
        $jenis_tindakan = $this->input->post('jenis_tindakan');
        $gambar = null;
    
        // Set upload configurations
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2 MB
        $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];
    
        // Load upload library
        $this->load->library('upload', $config);
    
        // Handle file upload
        if (!empty($_FILES['gambar']['name'])) {
            if ($this->upload->do_upload('gambar')) {
                $uploadData = $this->upload->data();
                $gambar = 'uploads/' . $uploadData['file_name']; // Save uploaded file path
            } else {
                // Log error if upload fails
                $error = $this->upload->display_errors();
                log_message('error', 'File upload error: ' . $error);
                show_error($error); // Optional: Debugging purpose
                return;
            }
        }
    
        // Prepare data for update
        $data = [
            'jenis_kesalahan' => $jenis_kesalahan,
            'jenis_tindakan' => $jenis_tindakan,
        ];
    
        // Include the uploaded image only if a new file was uploaded
        if ($gambar) {
            $data['gambar'] = $gambar;
        }
    
        // Update database
        $this->db->where('no_regis', $no_regis);
        $this->db->update('pemeliharaan', $data);
    
        // Redirect to the page with a success or error message
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update data.');
        }
    
        redirect('user/pemeliharaan');
    }
    
    public function report()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();

        $this->load->model('pemeliharaan_model'); // Pastikan model dimuat
        $data['pemeliharaan'] = $this->pemeliharaan_model->getPemeliharaanData();

        // Untuk menampilkan data di halaman
        $this->load->view('user/report', array_merge($data, $viewData));
    }

}
