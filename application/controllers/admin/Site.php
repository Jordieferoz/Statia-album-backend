<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
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

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

			redirect('admin/authentication/login');
		}
	}

	public function social()
	{

		$data['SOCIAL_LINKS'] = $this->Crud->Read('social_links', " `id` != '0' ORDER BY `id` DESC LIMIT 1");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/site/social', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function updateSocial()
	{

		$this->form_validation->set_rules('facebook', 'Facebook', 'trim');
		$this->form_validation->set_rules('twitter', 'Twitter', 'trim');
		$this->form_validation->set_rules('instagram', 'Instagram', 'trim');
		$this->form_validation->set_rules('pinterest', 'Pinterest', 'trim');
		$this->form_validation->set_rules('linkedin', 'LinkedIn', 'trim');
		$this->form_validation->set_rules('youtube', 'YouTube', 'trim');

		if ($this->form_validation->run()) {

			$data = [

				'facebook' => $this->input->post('facebook'),

				'twitter' => $this->input->post('twitter'),

				'instagram' => $this->input->post('instagram'),

				'pinterest' => $this->input->post('pinterest'),

				'linkedin' => $this->input->post('linkedin'),

				'youtube' => $this->input->post('youtube'),

				'updated_date' => date('Y-m-d'),

				'updated_time' => date('H:i:s')

			];

			$ifExists = $this->Crud->Count('social_links', " `id` != '0'");

			if ($ifExists > 0) {

				if (!$this->Crud->Update('social_links', $data, " `id` != '0'")) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');
				} else {

					$this->session->set_flashdata('success', 'Social media links updated!');
				}
			} else {

				if (!$this->Crud->Create('social_links', $data)) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');
				} else {

					$this->session->set_flashdata('success', 'New social media links added and updated!');
				}
			}

			redirect('admin/site/social');
		} else {

			$this->social();
		}
	}

	public function smsNumbers()
	{
		if (isset($_POST['submit'])) {
			extract($_POST);
			$data1 = [
				'number' => $number1
			];
			$this->Crud->Update('sms_numbers', $data1, " `id` = '1'");
			$data2 = [
				'number' => $number2
			];
			$this->Crud->Update('sms_numbers', $data2, " `id` = '2'");
			$data3 = [
				'number' => $number3
			];
			$this->Crud->Update('sms_numbers', $data3, " `id` = '3'");
			$this->session->set_flashdata('success', "Numbers updated and will be used for further notifications");
		}
		$data['NUMBERS'] = $this->Crud->Read('sms_numbers', " `status` = '1'");
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/site/numbers', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function faq()
	{
		if (isset($_POST['submit'])) {
			extract($_POST);
			$this->Crud->Create('faq', array(
				'question' => $question,
				'answer' => $answer,
				'added_on' => time()
			));
			$this->session->set_flashdata('success', "FAQ added");
			redirect('admin/site/faq/');
		}
		$data['FAQ'] = $this->Crud->Read('faq', " `id` <> '0'");
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/site/faqs', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function change()
	{
		$tableName = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$conditionId = $this->uri->segment(6);
		$condition = " `id` = '$conditionId'";
		$data = [
			'is_active' => $status
		];
		if ($this->Crud->Update($tableName, $data, $condition))
			$this->session->set_flashdata('success', "Success! Changes saved");
		else
			$this->session->set_flashdata('danger', "Something went wrong");
		$referer = basename($_SERVER['HTTP_REFERER']);
		redirect('admin/site/' . $referer);
	}

	public function deliveryCharges()
	{
		$data['PINCODES'] = $this->Crud->Read('pincodes', " `status` = '1'");
		if (isset($_POST['submit'])) {
			extract($_POST);
			foreach ($data['PINCODES'] as $key) {
				if (is_numeric(${'rain' . $key->id}) && is_numeric(${'night' . $key->id})) {
					$this->Crud->Update('pincodes', array(
						'rain_delivery_charge' => ${'rain' . $key->id},
						'night_delivery_charge' => ${'night' . $key->id}
					), " `id` = '$key->id'");
					$this->session->set_flashdata('success', "Charges updated");
				} else {
					$this->session->set_flashdata('warning', "Some prices couldn't be updated, please try again");
				}
			}
			redirect('admin/'.__CLASS__.'/'.__FUNCTION__);
		}
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/site/deliveryCharges', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function getBackup()
	{

		$fileName = PROJECT_NAME . time() . 'backup.zip';

		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = &$this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/home/' . $fileName, $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($fileName, $backup);
	}
}
