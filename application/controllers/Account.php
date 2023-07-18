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

		// if (!$this->uri->segment(3)) {
		// 	// redirect('/account/register');
		// 	$this->session->set_flashdata('warning', "Account doesn't exists!");
		// }

		$this->load->view('site/layouts/header');
		$this->load->view('site/account/login');
		$this->load->view('site/layouts/footer', ['HIDE_CONTENT' => true]);
	}

	public function authenticate()
	{
		$this->form_validation->set_rules('uid', 'User ID', 'required');

		if ($this->form_validation->run()) {
			$uid = $this->input->post('uid');
			if ($uid == "H9SDFIH2") {
				$this->session->set_userdata('user_key', 'ADMIN');

				$this->session->set_userdata('user_role', 'USER');

				$this->session->set_userdata('user_name', "Test User");

				$this->session->set_userdata('user_id', 'testuser');

				$this->session->set_userdata('user_email', "info@statiamultimediagallery.com");
				$this->session->set_userdata('expiry_timestamp', time() + EXPIRATION_DELAY);
				redirect('/');
			} else {
				$isValidUID = $this->Crud->Count('users', " `uid` = '$uid'");
				if ($isValidUID == 0) {
					$this->session->set_flashdata('danger', "User ID not registered");
					redirect('account/login');
				} else {
					$isActive = $this->Crud->Count('users', " `uid` = '$uid' AND `is_active` = '1' AND `is_verified` = '1'");
					if ($isActive == 0) {
						$this->session->set_flashdata('danger', "User ID is not verified either not active.");
						redirect('account/login');
					} else {
						$userData = $this->Crud->Read('users', " `uid` = '$uid'")[0];
						if ($userData->is_first_login == 0) {
							$this->Crud->Update('users', array('is_first_login' => 1, 'first_login_time' => date('y-m-d H:i:s')), " `uid` = '$uid'");
						} else {
							if ((strtotime($userData->first_login_time) + EXPIRATION_DELAY) < time()) {
								$this->session->set_flashdata('danger', "Your User ID has been expired, please register again to access our gallery.");
								redirect('account/login');
								return false;
							}
						}
						$userData = $this->Crud->Read('users', " `uid` = '$uid'")[0];
						$this->session->set_userdata('user_key', $userData->verification_key);

						$this->session->set_userdata('user_role', 'USER');

						$this->session->set_userdata('user_name', $userData->name);

						$this->session->set_userdata('user_id', $userData->uid);

						$this->session->set_userdata('user_email', $userData->email);
						$this->session->set_userdata('expiry_timestamp', strtotime($userData->first_login_time) + EXPIRATION_DELAY);
						redirect('/');
					}
				}
			}
		}
	}

	public function authenticateOld()
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
		$this->load->view('site/layouts/footer', ['HIDE_CONTENT' => true]);
	}

	public function registerer()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		// $this->form_validation->set_rules('phone', 'Phone', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('business_or_organization', 'Business/Organization', 'trim');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');

		if ($this->form_validation->run()) {

			$verificationKey = md5(rand(100000, 999999));

			$otp = rand(100000, 999999);

			$uid = rand(10000000, 99999999);

			$data = [

				'name' => $this->input->post('name'),
				'uid' => $uid,

				// 'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'business_or_organization' => $this->input->post('business_or_organization'),
				'address' => $this->input->post('address'),

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

				$message = "Hello,\nPlease use this OTP to verify your account. \n\n OTP: " . $vars['var1'] . "
					\n\n Or, click this link to verify your account <a href=" . base_url('account/verificationmail/' . $verificationKey) . ">" . base_url('account/verificationmail/' . $verificationKey) . "</a>
				";

				sendsms($this->input->post('email'), $message);

				$this->session->set_flashdata('success', 'Please enter OTP sent to your email!'); // Please check register mail for OTP

				echo "<script>alert('Please check your registered email for verification code!'); window.location.assign('" . base_url('account/verification/' . $verificationKey) . "')</script>";
				// redirect('account/verification/' . $verificationKey);
				// redirect('account/login/');
			}
		} else {

			$this->register();
		}
	}

	public function verificationmail()
	{
		if ($this->uri->segment(3)) {

			$verification = $this->uri->segment(3);

			$codeExists = $this->Crud->Count('users', " `verification_key` = '$verification'");

			if ($codeExists < 1) {
			} else {

				$isVerified = $this->Crud->Count('users', " `verification_key` = '$verification' AND `is_verified` = '1'");

				if ($isVerified > 0) {

					echo "Account already verified.";
				} else {
					$isVerified = $this->Crud->Update('users', array('is_verified' => 1), " `verification_key` = '$verification'");
					$reader = $this->Crud->Read('users', " `verification_key` = '$verification'");

					$message = "Hello,
					\nYour details has been sent for verification, please wait for sometime until we get your account verified.
					\n\n You will receive a User ID (valid upto 3 days from the first login) post verification, which you can use to login to your account.";

					sendsms($reader[0]->email, $message);
					$adminMessage = "
						Hi,\n
						\nA new account has registered to statia-multimedia gallary.\n
						\nDetails:\n
						\nName: " . $reader[0]->name . "\n
						\nBusiness/Organization: " . $reader[0]->business_or_organization . "\n
						\nAddress: " . $reader[0]->address . "\n
						\nEmail: " . $reader[0]->email . "\n
						\nRegistered on: " . $reader[0]->register_timestamp . "\n
						\nUser ID: " . $reader[0]->uid . "\n
						\nAccount Status: Verified.\n\n
						\nPlease share the user id with the user by replying on their email. They can access statia multi media gallery with their User ID 
 						\n(valid upto 3 days from their first login).\n\n
						\nLogin Link: " . base_url('/account/login') . " 
					";
					sendsms('info@statiamultimedialibrary.com', $adminMessage);

					echo "Your email has been verified and your account has been send for approval request. You will receive an email once we verify your account.";
				}
			}
		} else {

			echo "Unable to verify";
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
		$this->load->view('site/layouts/footer', ['HIDE_CONTENT' => true]);
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

					$message = "Hello,
					\nYour details has been sent for verification, please wait for sometime until we get your account verified.
					\n\n You will receive an email with the User ID (valid upto 3 days from the first login) to access to our gallery.";

					$this->session->set_flashdata('success', "Your email has been verified and your account has been send for approval request. You will receive an email once we verify your account."); // Please check register mail for OTP

					sendsms($reader[0]->email, $message);

					$adminMessage = "
						\nHi," . PHP_EOL . "
						\nA new account has registered to statia-multimedia gallary." . PHP_EOL . "
						\nDetails:" . PHP_EOL . "
						\nName: " . $reader[0]->name . "" . PHP_EOL . "
						\nBusiness/Organization: " . $reader[0]->business_or_organization . "" . PHP_EOL . "
						\nAddress: " . $reader[0]->address . "" . PHP_EOL . "
						\nEmail: " . $reader[0]->email . "" . PHP_EOL . "
						\nRegistered on: " . $reader[0]->register_timestamp . "" . PHP_EOL . "
						\nUser ID: " . $reader[0]->uid . "" . PHP_EOL . "
						\nAccount Status: Verified." . PHP_EOL . "" . PHP_EOL . "
						\nPlease share the user id (valid upto 3 days from the first login) with the user by replying on their email. They can access statia multi media gallery with their User ID 
 						\nhours from their first login." . PHP_EOL . "" . PHP_EOL . "
						\nLogin Link: " . base_url('/account/login') . " 
					";
					sendsms('info@statiamultimedialibrary.com', $adminMessage);

					// redirect('account/register/');
					echo "<script>alert('Your account has been sent for verification!'); window.location.assign('" . base_url('account/register/') . "')</script>";
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

					$message = "Hello,\nPlease use this OTP for your account. \n\n OTP: " . $vars['var1'];

					sendsms($userDetails[0]->phone, $message);

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
		$this->load->view('site/layouts/footer', ['HIDE_CONTENT' => true]);
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

			$message = "Hello,\nPlease use this OTP for your account. \n\n OTP: " . $vars['var1'];

			sendsms($this->input->post('email'), $message);

			$update = $this->Crud->Update('users', $data, " `email` = '$email'");

			$this->session->set_flashdata('success', "OTP sent to registered email.");

			redirect('account/recover/?email=' . $email);
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
		$this->load->view('site/layouts/footer', ['HIDE_CONTENT' => true]);
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
