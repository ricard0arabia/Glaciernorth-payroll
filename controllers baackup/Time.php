<?php
class Time extends CI_Controller {
	var $pgToLoad;
	
	public function __construct() {
		parent::__construct();
		#this will start the session
		session_start();
		
		if(!isset($_SESSION['userId']) || !isset($_SESSION['userLevel']) || !isset($_SESSION['employeeid']) || !isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
			redirect('home', 'location');
		}
		
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
	}

	public function index() {		
		$this->main();
	}	
	
	public function main() {
		#set default content to load 
		$this->pgToLoad = empty($this->pgToLoad) ? "employees" : $this->pgToLoad;
		$disMsg = "";
		
		#this will delete the record selected
		if($this->uri->segment(2) == 'timesheet') { 
			$this->timesheet();
		}
		
		if($this->uri->segment(2) == 'attendance') { 
			$this->attendance();
		}	

		if($this->uri->segment(2) == 'timelog') { 
			$this->timelog();
		}

		#this will logout the user and redirect to the page
		if($this->uri->segment(2) == 'logout') {
			session_destroy();
			redirect('home', 'location');
		}					
		
		$data = array ( 'pageTitle' => 'Payroll System | ADMINISTRATION',
						'disMsg'	=> $disMsg,												
						'mainCont'	=> $this->mainCont );
		
		$this->load->view('mainTpl', $data, FALSE);
	}
	

	#this will display the form when editing the product
	public function timesheet() {
		
	
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/hr/timesheet', '', TRUE);	
		
	}

	public function attendance() {
		
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/hr/attendance', '', TRUE);	
		
	}

	public function timelog() {
	
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
		$this->mainCont = $this->load->view('pages/timelog', '', TRUE);	
			
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