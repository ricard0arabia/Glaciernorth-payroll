<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $pgToLoad;
	
	public function __construct() {
		parent::__construct();
		
		#this will start the session
		session_start();
		
		#this will load the model
		$this->load->model('Contents');
		
		#get last uri segment to determine which content to load
		$continue = true;
		$i = 0;
		do {
			$i++;
			if ($this->uri->segment($i) != "") $this->pgToLoad = $this->uri->segment($i);
			else $continue = false;				
		} while ($continue);
		
		#get first uri segment to determine current section
		$this->sectToLoad = $this->uri->segment(1, false);
	}

	public function index() {		
		$this->main();
	}
	
	public function main() {
			
		#set default content to load 
		$this->pgToLoad = empty($this->pgToLoad) ? "home" : $this->pgToLoad;
		
		$disMsg = "";
		
		if($this->input->post('login') != '') {
			if($this->input->post('employeeid') != '' && $this->input->post('userpass') != '') {
				$disLogin = $this->Contents->getLogin();
				
				if(!empty($disLogin)) {
					$_SESSION['userId'] 	= $disLogin[0]['user_id'];
					$_SESSION['userLevel'] 	= $disLogin[0]['userlevel'];
					$_SESSION['employeeid'] 	= $disLogin[0]['employeeid'];
					$_SESSION['firstname']  = $disLogin[0]['firstname'];
					$_SESSION['lastname'] 	= $disLogin[0]['lastname'];					
					
					redirect('dashboard', 'location');									
				} else {
					$disMsg = "Invalid Employee Id/Password";
				}
			} else {
				$disMsg = "Enter Employee Id/Password.";
			}			
		}
		
		#this will logout the user and redirect to the page
		if($this->uri->segment(2) == 'logout') {
			session_destroy();
			redirect('home', 'location');
		}		
		
		#this is for the the new account
		if($this->uri->segment(2) == 'newacc') {
			$disMsg = "Account has been updated. Please re-login.";
		} 			
		
		$data = array ( 'pageTitle' => 'Payroll System | ADMINISTRATION',
						'disMsg'	=> $disMsg );
		
		$this->load->view('loginTpl', $data, FALSE);
	}
	
	public function _remap () {
		$this->main();
	
		// load model
		//$this->load->model('Contents');	
	
		// check if subsection exists
		/*$subSection = $this->Contents->checkNav($this->pgToLoad);
		if ($subSection) {
			// show the content for the subsection
			$this->main();		
		} else {
			// show a 404 error if subsection does not exist
			show_404();
		}*/
	}
}
?>