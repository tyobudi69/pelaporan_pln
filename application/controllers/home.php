<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct(Type $var = null) {
		parent::__construct();
		$this->load->model('Pelaporan_model');
	}
	public function index(){

    // Ambil data jumlah status pelaporan
    $jumlah_status_array = $this->Pelaporan_model->getJumlahStatusPelaporan();
    $data['jumlah_status'] = 0;

    // Hitung total pelaporan
    foreach ($jumlah_status_array as $status_total) {
        $data['jumlah_status'] += $status_total['jumlah'];
    }

    // Hitung jumlah dalam penanganan dan selesai
    $data['jumlah_dalam_penanganan'] = $this->Pelaporan_model->hitungStatusDalamPenanganan();
    $data['Selesai'] = $this->Pelaporan_model->hitungStatusSelesai();
    
    // Muat tampilan
    $this->load->view('template/home_header');
    // $this->load->view('home/index', array_merge $data, $viewData, $status);
    // $this->load->view('template/home_footer');


	$totalKejadian = $this->db->count_all('pelaporan');

	$dalamPenanganan = $this->db->where('status', 'Dalam Penanganan')
	->count_all_results('pelaporan');

	$kejadianSelesai = $this->db->where('status', 'Selesai')
	->count_all_results('pelaporan');

	// Kirim data ke view
	$status = [
		'totalKejadian' => $totalKejadian,
		'dalamPenanganan' => $dalamPenanganan,
		'kejadianSelesai' => $kejadianSelesai
	];

	$monthlyReportData = $this->Pelaporan_model->getMonthlyReport();

	$cityReportData = $this->Pelaporan_model->getDamageByCity();
	$data['cityChartData'] = [
		'labels' => array_column($cityReportData, 'kota'),
		'data' => array_column($cityReportData, 'jumlah'),
	];

	// Siapkan data untuk bar chart
	$data['kerusakan'] = [
		'Butuh Penanganan' => $this->Pelaporan_model->countByStatus('Butuh Penanganan'),
		'Dalam Penanganan' => $this->Pelaporan_model->countByStatus('Dalam Penanganan'),
        'Selesai' => $this->Pelaporan_model->countByStatus('Selesai'),
	];
	
	$viewData['pelaporan'] = $this->Pelaporan_model->getAllPelaporan();


	// Untuk request AJAX 
	if($this->input->is_ajax_request()){
		echo json_encode(['data' => $viewData['pelaporan']]);
		return;
	}

	// Untuk menampilkan data di halaman
	$this->load->view('home/index', array_merge($data, $viewData, $status));
	$this->load->view('template/home_footer');
	}


	// Menyiapkan data bulanan
	private function prepareMonthlyData($monthlyReportData)
	{
		$monthlyData = array_fill(1, 12, 0);

		foreach($monthlyReportData as $row){
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


    public function about()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/about');
		$this->load->view('template/home_footer');

	}

    public function service()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/service');
		$this->load->view('template/home_footer');

	}

    public function blog()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/blog');
		$this->load->view('template/home_footer');

	}

	public function detail()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/detail');
		$this->load->view('template/home_footer');

	}

	public function price()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/price');
		$this->load->view('template/home_footer');

	}

	public function feature()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/feature');
		$this->load->view('template/home_footer');

	}

	public function team()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/team');
		$this->load->view('template/home_footer');

	}

	public function testimonial()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/testimonial');
		$this->load->view('template/home_footer');

	}

	public function quote()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/quote');
		$this->load->view('template/home_footer');

	}

	public function contact()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/contact');
		$this->load->view('template/home_footer');

	}
}