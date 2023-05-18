<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->helper('otp');
	}

	public function login()
	{

		if ($this->session->userdata('user_key')) {

			redirect('/');
		}

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/login');
		$this->load->view('site/layouts/footer', [ 'HIDE_CONTENT' => true ]);
	}

	public function authenticate()
	{

		$this->form_validation->set_rules('email', 'Email', 'required|trim');

		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {

			$email = $this->input->post('email');

			$password = $this->input->post('password');

			$operatingSystem = $this->getOS();

			$browser = $this->getBrowser();

			$isValidEmail = $this->Crud->Count('users', " `email` = '$email'");

			if ($isValidEmail == 0) {
				$this->session->set_flashdata('danger', "Email not registered");
				redirect('account/login');
			}

			$isActive = $this->Crud->Count('users', " `email` = '$email' AND `is_active` = '1'");

			if ($isActive == 1) {

				$isEmail = $this->Crud->Count('users', " `email` = '$email'");

				if ($isEmail > 0) {

					$reader = $this->Crud->Read('users', " `email` = '$email'");

					foreach ($reader as $key) {

						$verificationKey = $key->verification_key;

						$name = $key->name;

						$id = $key->id;

						$passwordDecrypted = $this->encryption->decrypt($key->password);
					}

					$isVerified = $this->Crud->Count('users', " `email` = '$email' AND `is_verified` = '1'");

					if ($isVerified > 0) {

						if ($passwordDecrypted === $password) {

							$loginData = [

								'user_id' => $key->id,

								'user_role' => 'USER',

								'os' => $operatingSystem,

								'browser' => $browser,

								'ip' => $_SERVER['REMOTE_ADDR'],

								'login_date' => date('Y-m-d'),

								'login_time' => date('H:i:s')

							];

							$this->Crud->Create('login_history', $loginData);

							$this->session->set_userdata('user_key', $verificationKey);

							$this->session->set_userdata('user_role', 'USER');

							$this->session->set_userdata('user_name', $name);

							$this->session->set_userdata('user_id', $id);

							$this->session->set_userdata('user_email', $email);
							$this->session->set_userdata('expiry_timestamp', time() + EXPIRATION_DELAY);

							redirect('/');
						} else {

							$this->session->set_flashdata('danger', "Access denied, incorrect password entered");

							redirect('account/login/');
						}
					} else {

						$this->session->set_flashdata('warning', "Please verify your email to proceed");

						redirect('account/verification/' . $verificationKey);
					}
				} else {

					$this->session->set_flashdata('danger', "Email not registered! <a href = '" . site_url('account/register/') . "'>Register now</a>");

					redirect('account/login');
				}
			} else {

				$this->session->set_flashdata('danger', "Account disabled!");

				redirect('account/login');
			}
		} else {

			$this->login();
		}
	}

	public function register()
	{

		if ($this->session->userdata('key')) {

			redirect('/');
		}

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/register');
		$this->load->view('site/layouts/footer');
	}

	public function registerer()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');

		if ($this->form_validation->run()) {

			$verificationKey = md5(rand(100000, 999999));

			$otp = rand(100000, 999999);

			$encryptedPassword = $this->encryption->encrypt($this->input->post('password'));

			$data = [

				'name' => $this->input->post('name'),

				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),

				'password' => $encryptedPassword,

				'otp' => $otp,

				'verification_key' => $verificationKey,

				'joined_date' => date('Y-m-d'),

				'joined_time' => date('H:i:s')

			];

			$id = $this->Crud->Create('users', $data);

			if ($id > 0) {

				$vars = array(
					'var1' => $otp
				);

				sendsms($this->input->post('phone'), $vars);

				$this->session->set_flashdata('success', 'Registration success!.'); // Please check register mail for OTP

				// redirect('account/verification/' . $verificationKey);
				echo "<script>alert('Registration successful, please login with your credentials to access the images.'); window.location.assign('" . base_url('account/login/') . "')</script>";
				// redirect('account/login/');
			}
		} else {

			$this->register();
		}
	}

	public function verification()
	{

		if ($this->uri->segment(3)) {

			$verification = $this->uri->segment(3);

			$codeExists = $this->Crud->Count('users', " `verification_key` = '$verification'");

			if ($codeExists < 1) {

				$this->session->set_flashdata('danger', 'Unable to verify');

				redirect('account/login/');
			} else {

				$isVerified = $this->Crud->Count('users', " `verification_key` = '$verification' AND `is_verified` = '1'");

				if ($isVerified > 0) {

					redirect('/');
				}
			}
		} else {

			$this->session->set_flashdata('danger', 'Unable to verify');

			redirect('account/login/');
		}

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/verification');
		$this->load->view('site/layouts/footer');
	}

	public function verify()
	{

		if ($this->uri->segment(3)) {

			$verification = $this->uri->segment(3);

			$otp = $this->input->post('otp');

			$codeExists = $this->Crud->Count('users', " `verification_key` = '$verification'");

			if ($codeExists > 0) {

				$otpCorrection = $this->Crud->Count('users', " `verification_key` = '$verification' AND `otp` = '$otp'");

				if ($otpCorrection > 0) {

					$dataUpdate = [

						'is_verified' => 1

					];

					$this->Crud->Update('users', $dataUpdate, " `verification_key` = '$verification' AND `otp` = '$otp'");

					$reader = $this->Crud->Read('users', " `verification_key` = '$verification' AND `otp` = '$otp'");

					foreach ($reader as $key) {

						$verification = $key->verification_key;

						$name = $key->name;

						$id = $key->id;
					}

					$this->session->set_userdata('user_key', $verification);

					$this->session->set_userdata('user_role', 'USER');

					$this->session->set_userdata('user_name', $name);

					$this->session->set_userdata('user_email', $reader[0]->email);

					$this->session->set_userdata('user_id', $id);
					$this->session->set_userdata('expiry_timestamp', time() + EXPIRATION_DELAY);

					redirect('/');
				} else {

					$this->session->set_flashdata('danger', 'Incorrect OTP!');

					redirect('account/verification/' . $verification);
				}
			} else {

				$this->session->set_flashdata('danger', 'Sorry we could\'nt verify your otp, please login to re-verify');

				redirect('account/login/');
			}
		} else {

			$this->session->set_flashdata('danger', 'Sorry we could\'nt verify your otp, please login to re-verify');

			redirect('account/login/');
		}
	}

	public function resend()
	{

		if ($this->uri->segment(3)) {

			$verification = $this->uri->segment(3);

			$codeExists = $this->Crud->Count('users', " `verification_key` = '$verification'");

			if ($codeExists < 1) {

				$this->session->set_flashdata('danger', 'Unable to verify');

				redirect('account/login/');
			} else {

				$isVerified = $this->Crud->Count('users', " `verification_key` = '$verification' AND `is_verified` = '1'");

				if ($isVerified > 0) {

					redirect('/');
				} else {

					$userDetails = $this->Crud->Read('users', " `verification_key` = '$verification' AND `is_verified` = '0'");

					$thisOTP = rand(100000, 999999);

					$otpData = [

						'otp' => $thisOTP

					];

					$vars = array(

						'var1' => $thisOTP
					);

					sendsms($userDetails[0]->phone, $vars);

					$this->Crud->Update('users', $otpData, " `verification_key` = '$verification'");

					$this->session->set_flashdata('success', 'OTP Sent Successfully!');

					redirect('account/verification/' . $verification);
				}
			}
		} else {

			$this->session->set_flashdata('danger', 'Unable to verify');

			redirect('account/login');
		}
	}

	public function recover()
	{

		if (isset($_GET['email'])) {

			$email = $_GET['email'];

			$ifExists = $this->Crud->Count('users', " `email` = '$email'");

			if ($ifExists < 1) {

				$this->session->set_flashdata('danger', 'Email doesn\'t exists!');

				redirect('account/login');
			}
		}

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/recover');
		$this->load->view('site/layouts/footer');
	}

	public function otp()
	{

		$email = $this->input->post('email');

		$isEmail = $this->Crud->Count('users', " `email` = '$email'");

		if ($isEmail > 0) {

			$userDetails = $this->Crud->Read('users', " `email` = '$email'");

			$thisOTP = rand(100000, 999999);

			$data = [

				'asked_recovery' => 1,

				'recovery_otp' => $thisOTP

			];

			$vars = array(
				'var1' => $thisOTP,
			);

			sendsms($this->input->post('email'), $vars);

			$update = $this->Crud->Update('users', $data, " `email` = '$email'");

			$this->session->set_flashdata('success', "OTP sent to registered email.");

			// redirect('account/recover/?email=' . $email);
		} else {

			$this->session->set_flashdata('danger', "Email not registered! <a href = '" . site_url('account/register/') . "'>Register now</a>");

			redirect('account/recover');
		}
	}

	public function tryrecover()
	{

		$email = $this->input->post('email');

		$otp = $this->input->post('otp');

		$isValid = $this->Crud->Count('users', " `email` = '$email' AND `recovery_otp` = '$otp'"); # AND `asked_recovery` = '1'

		$changeKey = hash('sha512', time() . rand());

		if ($isValid > 0) {

			$data = [

				'asked_recovery' => 0,

				'recovery_otp' => null,

				'recovery_key' => $changeKey

			];

			$this->Crud->Update('users', $data, " `email` = '$email'");

			redirect('account/change/' . $changeKey);
		} else {

			$this->session->set_flashdata('danger', "Sorry that didn't work, please try again!");

			redirect('account/recover/?email=' . $email);
		}
	}
	public function change()
	{

		if (!$this->uri->segment(3)) {

			$this->session->set_flashdata('danger', "Invalid recovery key");

			redirect('account/login');
		} else {

			$key = $this->uri->segment(3);

			$ifValid = $this->Crud->Count('users', " `recovery_key` = '$key'");

			if ($ifValid == 0) {

				$this->session->set_flashdata('danger', "Invalid recovery key");

				redirect('account/login');
			}
		}

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/change');
		$this->load->view('site/layouts/footer');
	}

	public function changer()
	{

		if ($this->uri->segment(3)) {

			$key = $this->uri->segment(3);

			$ifValid = $this->Crud->Count('users', " `recovery_key` = '$key'");

			if ($ifValid > 0) {

				$password = $this->input->post('password');

				if ($password == '') {

					$this->session->set_flashdata('danger', "Cannot encrypt your password, please try again");

					redirect('account/change/' . $key);
				} else {

					$encryptedPassword = $this->encryption->encrypt($password);

					$data = [

						'password' => $encryptedPassword

					];

					$this->Crud->Update('users', $data, " `recovery_key` = '$key'");

					$eraseKey = [

						'recovery_key' => null

					];

					$this->Crud->Update('users', $eraseKey, " `recovery_key` = '$key'");

					$this->session->set_flashdata('success', "Password changed successfully");

					redirect('account/login');
				}
			} else {

				$this->session->set_flashdata('danger', "Invalid recovery key");

				redirect('account/login');
			}
		} else {

			$this->session->set_flashdata('danger', "Invalid recovery key");

			redirect('account/login');
		}
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

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}
	}
}
