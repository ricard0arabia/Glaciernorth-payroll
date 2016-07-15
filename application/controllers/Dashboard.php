<?php
class Dashboard extends CI_Controller {
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
		$this->pgToLoad = empty($this->pgToLoad) ? "faqs" : $this->pgToLoad;
		$disMsg = "";
		
		#this will delete the record selected
		if($this->uri->segment(2) == 'remove') { 
			$this->deleteEmpCorner();
		}
		
		#this will check if the post value is trigger
		if(isset($_POST['signin_submit'])) {
			$this->insertEmpCorner();	
		}					
		
		#this will check if the post value is trigger
		if(isset($_POST['modProd'])) {
			$this->updateEmpCorner();	
		}					
		
		if($this->uri->segment(2) == 'addEmpCorner' || $this->uri->segment(2) == 'editEmpCorner') {
			#this display the form for products
			$this->diplayCornerForm();
		} else {
			#this will display the job orders
			$this->displayDashboard();		
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
	
	public function displayDashboard() {
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$this->mainCont = $this->load->view('pages/dashboard', $data, TRUE);
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