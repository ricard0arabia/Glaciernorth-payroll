<?php



class Time extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','time');
	}

	public function index() {	

        if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{

		$this->load->helper('url');	
        $this->load->view('header');
        $data['user'] = $this->session->userdata('username');
        $this->load->view('pages/attendance',$data);
		$this->load->view('footer');
        }
	
	}	

           

	
}
?>