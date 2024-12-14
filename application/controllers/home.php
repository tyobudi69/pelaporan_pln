<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function index()
	{
		$this->load->view('template/home_header');
		$this->load->view('home/index');
		$this->load->view('template/home_footer');

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