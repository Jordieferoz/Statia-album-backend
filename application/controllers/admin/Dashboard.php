<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $myId;
	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

			redirect('admin/authentication/login');
		}
		$this->myId = ($this->session->userdata('role') == 'ADMIN') ? 0 : $this->session->userdata('id');
	}

	public function index()
	{
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/layouts/footer');
	}

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}

		redirect('admin/authentication/login');
	}
}
