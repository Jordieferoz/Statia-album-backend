<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorization extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->model('Crud');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

			redirect('admin/authentication/login');
		}
	}

	public function category()
	{

		$data['CATEGORIES'] = $this->Crud->Read('categories', " `is_active` = '1' ORDER BY category ASC");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/categorization/category', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function inactiveCategory()
	{

		$data['CATEGORIES'] = $this->Crud->Read('categories', " `is_active` = '0' ORDER BY category ASC");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/categorization/inactive-category', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function newCategory()
	{

		$this->form_validation->set_rules('category', 'Category', 'required|trim');

		if ($this->form_validation->run()) {

			$category = $this->input->post('category');

			$isExists = $this->Crud->Count('categories', " `category` = '$category'");

			if ($isExists > 0) {

				$this->session->set_flashdata('warning', "Category already exists");
			} else {

				$config['upload_path'] = FCPATH . 'uploads/categories/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				// $config['max_size'] = 2000;

				// $config['max_width'] = 1500;

				$config['encrypt_name'] = TRUE;

				// $config['max_height'] = 1500;
				$this->load->library('image_lib');
				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				$categoryFileName = '';

				if (!$this->upload->do_upload('categoryImage')) {

					$error = array('error' => $this->upload->display_errors());

					$this->session->set_flashdata('warning', $this->upload->display_errors());
				} else {

					$image_metadata = $this->upload->data();

					$categoryFileName = $image_metadata['file_name'];
					$configer =  array(
						'image_library'   => 'gd2',
						'source_image'    =>  $image_metadata['full_path'],
						'maintain_ratio'  =>  TRUE,
						'width'           =>  400,
						'height'          =>  400,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();
				}

				$data = [

					'category' => $this->input->post('category'),

					'file_name' => $categoryFileName,

					'added_date' => date('Y-m-d'),

					'added_time' => date('H:i:s')

				];

				if ($this->Crud->Create('categories', $data))

					$this->session->set_flashdata('success', "Category added");

				else

					$this->session->set_flashdata('danger', "Something went wrong");
			}

			redirect('admin/categorization/category');
		} else {

			$this->category();
		}
	}

	public function editCategory()
	{

		$this->form_validation->set_rules('editCategoryText', 'Category', 'required|trim');

		if ($this->form_validation->run()) {

			$category = $this->input->post('editCategoryText');

			$categoryId = $this->input->post('editCategoryId');

			$isExists = $this->Crud->Count('categories', " `category` = '$category'");

			if ($isExists > 1) {

				$this->session->set_flashdata('warning', "Another category with this name already exists");
			} else {
				$oldCategory = $this->Crud->Read('categories', " `id` = '$categoryId'")[0]->category;

				if (isset($_FILES['categoryImageModal']) && is_uploaded_file($_FILES['categoryImageModal']['tmp_name'])) {

					$config['upload_path'] = FCPATH . 'uploads/categories/';

					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$config['encrypt_name'] = TRUE;

					// $config['max_height'] = 1500;

					$this->upload->initialize($config);

					if (!$this->upload->do_upload('categoryImageModal')) {

						$error = array('error' => $this->upload->display_errors());

						$this->session->set_flashdata('warning', $this->upload->display_errors());

						redirect('admin/categorization/category');
					} else {

						$image_metadata = $this->upload->data();

						$categoryFileName = $image_metadata['file_name'];
					}

					$data = [

						'category' => $this->input->post('editCategoryText'),

						'file_name' => $categoryFileName

					];
				} else {

					$data = [
						'category' => $this->input->post('editCategoryText')

					];
				}

				if ($this->Crud->Update('categories', $data, " `id` = '$categoryId'")) {
					// update product table
					// $newCategory = $this->input->post('editCategoryText');
					// $this->Crud->Update('photos', array(
					// 	'categories' => $newCategory
					// ), " `categories` = '$oldCategory'");
					$this->session->set_flashdata('success', "Changes saved");
				} else {
					$this->session->set_flashdata('danger', "Something went wrong");
				}
			}

			redirect('admin/categorization/category');
		} else {

			$this->category();
		}
	}

	public function changeStatus()
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

		redirect('admin/categorization/' . $referer);
	}
}
