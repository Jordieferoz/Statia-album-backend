<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

	 public function __construct() {

		parent::__construct();

		$this->load->model('admin/Photos_model');

		$this->load->library('form_validation');

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

            redirect('admin/authentication/login');

        }

     }

	 public function new() {

		$categories = $this->Crud->Read('categories', " `is_active` = '1' ORDER BY category ASC");

		$data['CATEGORIES'] = null;

		if($categories) {

			$data['CATEGORIES'] =  $categories;

		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/videos/new-video', $data);
		$this->load->view('admin/layouts/footer');

	 }

	 public function published() {

		$publishedPosts = $this->Photos_model->publishedPosts(false);

		$data['PUBLISHED_POSTS'] = [];

		if ($publishedPosts) {

			$data['PUBLISHED_POSTS'] =  $publishedPosts;

		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/videos/published-videos', $data);
		$this->load->view('admin/layouts/footer');

	 }

	 public function unpublished() {

		$unpublishedPosts = $this->Photos_model->unpublishedPosts(false);

		$data['UNPUBLISHED_POSTS'] = [];

		if ($unpublishedPosts) {

			$data['UNPUBLISHED_POSTS'] =  $unpublishedPosts;

		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/videos/unpublished-videos', $data);
		$this->load->view('admin/layouts/footer');

	 }

	 public function edit() {

		$id = $this->uri->segment(4);

			$validator = $this->Photos_model->idValidator($id);

			if ($validator == true) {

				$categories = $this->Photos_model->getCategories();

				$data['CATEGORIES'] = null;
		
				if($categories) {
		
					$data['CATEGORIES'] =  $categories;
		
				}
		
				$data['POST_DETAILS'] = $this->Photos_model->editPost($id);

			} else {

				$this->session->set_flashdata('error', 'Access denied');

				redirect('admin/videos/published');

			}

			$this->load->view('admin/layouts/header');
			$this->load->view('admin/layouts/nav');
			$this->load->view('admin/layouts/bar');
			$this->load->view('admin/videos/edit-video', $data);
			$this->load->view('admin/layouts/footer');

	 }

	 public function newVideo() {

		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run()) {

			$config['upload_path'] = FCPATH.'uploads/videos/';

			$config['allowed_types'] = '*';//'mp4|wmv|mpeg|mov|mpg|heic';

			// $config['max_size'] = 20480;

			$config['encrypt_name'] = TRUE;

			// $this->load->library('upload', $config);

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('coverVideo')) {

				$this->session->set_flashdata('error', $this->upload->display_errors());

				redirect('admin/videos/new');
			
			}

			else {
			
				$image_metadata = $this->upload->data();

				$config['upload_path'] = FCPATH.'uploads/thumbnails/';

				$config['allowed_types'] = '*';//'gif|jpg|png|jpeg|heic';

				// $config['max_size'] = 2000;

				$config['encrypt_name'] = TRUE;

				$this->upload->initialize($config);

				$thumbnail_metadata = [];

				if (!$this->upload->do_upload('thumbnailImage')) {

					$this->session->set_flashdata('error', "Thumbnail: " . $this->upload->display_errors());

				} else {
					$thumbnail_metadata = $this->upload->data();
				}

				$postData = [

					'title' => $this->input->post('title'),

					'user_id' => $this->session->userdata('id'),

					'description' => $this->input->post('description'),

					'category_id' => $this->input->post('category'),

					'added_time' => date('H:i:s'),

					'remote_address' => $_SERVER['REMOTE_ADDR'],

					'file_name' => $image_metadata['file_name'],

					'thumbnail_path' => isset($thumbnail_metadata['file_name']) ? $thumbnail_metadata['file_name'] : null,

					'file_type' => $image_metadata['file_type'],

					'file_path' => $image_metadata['file_path'],

					'full_path' => $image_metadata['full_path'],

					'raw_name' => $image_metadata['raw_name'],

					'orig_name' => $image_metadata['orig_name'],

					'client_name' => $image_metadata['client_name'],

					'file_ext' => $image_metadata['file_ext'],

					'file_size' => $image_metadata['file_size'],

					'is_image' => $image_metadata['is_image'],

					'image_width' => $image_metadata['image_width'],

					'image_height' => $image_metadata['image_height'],

					'image_type' => $image_metadata['image_type'],

					'added_date' => date('Y-m-d'),

					'added_time' => date('H:i:s')

				];

				
				$isSucceed = $this->Photos_model->insertPost($postData);

				if ($isSucceed != '') {

					$this->session->set_flashdata('success', 'Success! Your video has been uploaded.');

					redirect('admin/videos/new');

				} else {
					$this->session->set_flashdata('error', 'Something went wrong, please try again later');
					
					redirect('admin/videos/new');
					
				}

			}
			
		} else {
			$this->session->set_flashdata('error', 'Validation Errors');

			redirect('admin/videos/new');

		}

	 }

	 public function unpublish($id) {

		$validator = $this->Photos_model->idValidator($id);

		if ($validator == true) {

			$status = [

				'status' => 0

			];

			$isUnpublished = $this->Photos_model->unpublish($id, $status);

			if ($isUnpublished == true) {

				$this->session->set_flashdata('success', 'Post unpublished!');

				redirect('admin/videos/published');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again');

				redirect('admin/videos/published');

			}

		} else {

			$this->session->set_flashdata('error', 'Access denied');

			redirect('admin/videos/published');

		}

	 }

	 public function publish($id) {

		$validator = $this->Photos_model->idValidator($id);

		if ($validator == true) {

			$status = [

				'status' => 1

			];

			$isPublished = $this->Photos_model->publish($id, $status);

			if ($isPublished == true) {

				$this->session->set_flashdata('success', 'Post published!');

				redirect('admin/videos/unpublished');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again');

				redirect('admin/videos/unpublished');

			}

		} else {

			$this->session->set_flashdata('error', 'Access denied');

			redirect('admin/videos/unpublished');

		}

	 }

	 public function updateVideo() {

		$id = $this->input->post('thisId');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run()) {

			$videoData = $this->Photos_model->getSingleRecord($id);

			echo json_encode($videoData);

			$thumbnail_metadata = ['file_name' => $videoData->thumbnail_path];

			if (isset($_FILES['thumbnailImage']) && is_uploaded_file($_FILES['thumbnailImage']['tmp_name'])) {

				$config['upload_path'] = FCPATH.'uploads/thumbnails/';

				$config['allowed_types'] = '*';//'gif|jpg|png|jpeg|heic';

				// $config['max_size'] = 2000;

				$config['encrypt_name'] = TRUE;

				$this->upload->initialize($config);


				if (!$this->upload->do_upload('thumbnailImage')) {

					$this->session->set_flashdata('error', "Thumbnail: " . $this->upload->display_errors());

				} else {
					$thumbnail_metadata = $this->upload->data();
				}

			}

			if (isset($_FILES['coverVideo']) && is_uploaded_file($_FILES['coverVideo']['tmp_name'])) {

				$config['upload_path'] = FCPATH.'uploads/videos/';

				$config['allowed_types'] = '*';//'mp4|wmv|mpeg|mov|mpg|heic';

				// $config['max_size'] = 20480;

				$config['encrypt_name'] = TRUE;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('coverVideo')) {

					$this->session->set_flashdata('danger', $this->upload->display_errors());

					redirect('admin/videos/edit/' . $id);
				
				} else {
			
					$image_metadata = $this->upload->data();

					$imageData = [

						'title' => $this->input->post('title'),

						'user_id' => $this->session->userdata('id'),

						'description' => $this->input->post('description'),

						'category_id' => $this->input->post('category'),

						'last_update_remote' => $_SERVER['REMOTE_ADDR'],

						'file_name' => $image_metadata['file_name'],

						'thumbnail_path' => $thumbnail_metadata['file_name'],

						'file_type' => $image_metadata['file_type'],

						'file_path' => $image_metadata['file_path'],

						'full_path' => $image_metadata['full_path'],

						'raw_name' => $image_metadata['raw_name'],

						'orig_name' => $image_metadata['orig_name'],

						'client_name' => $image_metadata['client_name'],

						'file_ext' => $image_metadata['file_ext'],

						'file_size' => $image_metadata['file_size'],

						'is_image' => $image_metadata['is_image'],

						'image_width' => $image_metadata['image_width'],

						'image_height' => $image_metadata['image_height'],

						'image_type' => $image_metadata['image_type'],

					];

					$isPostUpdated = $this->Photos_model->updatePost($id, $imageData);

				}
				
			} else {

				$imageData = [

					'title' => $this->input->post('title'),

					'user_id' => $this->session->userdata('id'),

					'description' => $this->input->post('description'),

					'thumbnail_path' => $thumbnail_metadata['file_name'],

					'category_id' => $this->input->post('category'),

					'last_update_remote' => $_SERVER['REMOTE_ADDR'],

				];

				$isPostUpdated = $this->Photos_model->updatePost($id, $imageData);
				
			}
			
			if ($isPostUpdated != '') {

				$this->session->set_flashdata('success', 'Changes made.');

				redirect('admin/videos/published');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again later');

				redirect('admin/videos/edit/' . $id);

			}

		} else {

			redirect('admin/videos/edit/' . $id);

		}

	}

	public function changeStatus()
	{

		$tableName = $this->uri->segment(4);

		$status = $this->uri->segment(5);

		$conditionId = $this->uri->segment(6);

		$condition = " `id` = '$conditionId'";

		$data = [

			'status' => $status

		];

		if ($this->Crud->Update($tableName, $data, $condition))

			$this->session->set_flashdata('success', "Success! Changes saved");

		else

			$this->session->set_flashdata('danger', "Something went wrong");

		$referer = basename($_SERVER['HTTP_REFERER']);

		redirect('admin/videos/' . $referer);
	}

}
