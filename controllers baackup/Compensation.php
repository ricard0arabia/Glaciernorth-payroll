<?php
class Compensation extends CI_Controller {
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
		$this->pgToLoad = empty($this->pgToLoad) ? "payslip" : $this->pgToLoad;
		$disMsg = "";
		
		#this will delete the record selected
		if($this->uri->segment(2) == 'payslip') { 
			$this->payslip();
		}
		if($this->uri->segment(4) == 'view') { 
			$this->view();
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
	
	public function payslip() {
	
			$data['paylist'] = $this->Contents->exeGetPayperiod();
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/payslip', $data, TRUE);
	
	}
    public function view(){
    	$data['payperiod'] = $this->Contents->exeGetPayperiodToEdit($this->uri->segment(3));
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['ot'] = $this->Contents->exetGetOvertime($this->uri->segment(3));
			$data['ab'] = $this->Contents->exetGetAbsences($this->uri->segment(3));
			$this->mainCont = $this->load->view('pages/payslipform', $data, TRUE);
    		
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