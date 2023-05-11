<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	 public function __construct() {

		parent::__construct();

		$this->load->library('form_validation');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

            redirect('admin/authentication/login');

        }

     }

     public function active() {
        $data['ACTIVE_USERS'] = $this->Crud->Read('users', " `is_active` = '1' AND `is_verified` = '1'");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/users/active', $data);
		$this->load->view('admin/layouts/footer');
    }

    public function unverified() {
       $data['INACTIVE_USERS'] = $this->Crud->Read('users', " `is_verified` = '0'");

       $this->load->view('admin/layouts/header');
       $this->load->view('admin/layouts/nav');
       $this->load->view('admin/layouts/bar');
       $this->load->view('admin/users/unverified', $data);
       $this->load->view('admin/layouts/footer');
   }

    public function changeStatus() {
       $tableName = $this->uri->segment(4);
       $status = $this->uri->segment(5);
       $conditionId = $this->uri->segment(6);
       $condition = " `id` = '$conditionId'";
       $data = [
           'is_active' => $status
       ];
       if($this->Crud->Update($tableName, $data, $condition))
           $this->session->set_flashdata('success', "Success! Changes saved");
       else
           $this->session->set_flashdata('danger', "Something went wrong");
           $referer = basename($_SERVER['HTTP_REFERER']);
       redirect('admin/users/'.$referer);
    }

    public function blocked() {
       $data['BLOCKED_USERS'] = $this->Crud->Read('users', " `is_active` = '0'");

       $this->load->view('admin/layouts/header');
       $this->load->view('admin/layouts/nav');
       $this->load->view('admin/layouts/bar');
       $this->load->view('admin/users/blocked', $data);
       $this->load->view('admin/layouts/footer');
   }

}