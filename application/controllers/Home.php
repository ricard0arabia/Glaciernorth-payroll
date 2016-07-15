<?php
if(!defined('BASEPATH')) exit('Hacking Attempt: Get out of the system ..!');

	class Home extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Contents');
		}

		public function index(){

			if($this->session->userdata('isLogin') == FALSE)
		{

		redirect('login/login_form');

		}else{

			$this->load->model('Contents');
			$user = $this->session->userdata('username');
			$data['level'] = $this->session->userdata('level');
			$data['user'] = $this->Contents->userData($user);
			$this->load->view('header');
			$this->load->view('pages/dashboard', $data);
			$this->load->view('footer');
		}
	}
}
?>
