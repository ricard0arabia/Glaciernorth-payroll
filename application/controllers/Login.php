<?php


class Login extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('Contents');
		$this->load->library(array('form_validation','session'));
		$this->load->database();
		$this->load->helper('url');
	}

	public function index(){

	$session = $this->session->userdata('isLogin');

		if($session == FALSE){

		redirect('login/login_form');

		}else{

		redirect('home');

		}
	}

	public function login_form(){

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

	if($this->form_validation->run()==FALSE){

		$this->load->view('login');

	}
	else{

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$cek = $this->Contents->takeUser($username, $password, $level);

		if($cek <> 0)
		{
			$this->session->set_userdata('isLogin', TRUE);
			$this->session->set_userdata('username',$username);
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('level',$level);
			redirect('home');
		}else
		{
			echo " <script>
			alert('Failed Login: Check your username and password!');
			history.go(-1);
			</script>";
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login/login_form');
		}
	}
?>
