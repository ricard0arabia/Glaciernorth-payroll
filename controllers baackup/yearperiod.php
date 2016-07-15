<?php
class Yearperiod extends CI_Controller {
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
		$this->pgToLoad = empty($this->pgToLoad) ? "yearperiod" : $this->pgToLoad;
		$disMsg = "";
		
		#this will delete the record selected
		if($this->uri->segment(2) == 'delete') { 
			$this->deleteRecord();
		}
		
		#this will check if the post value is trigger
		if(isset($_POST['addnew'])) {
			$this->addRecord();	
		}					
		
		#this will check if the post value is trigger
		if(isset($_POST['saveinfo'])) {
			$this->updateinfo();	
		}		
		
		if($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit') {
			#this display the form for products
			$this->displayForm();
		} else {
			#this will display the job orders
			$this->getYearperiod();		
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
	
	public function getYearperiod() {
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$data['yearlist'] = $this->Contents->exeGetYearperiod();
		$this->mainCont = $this->load->view('pages/yearperiodlist', $data, TRUE);
	}

	#this will display the form when editing the product
	public function displayForm() {
		if($this->uri->segment(2) == 'edit') { 
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['yearperiod'] = $this->Contents->exeGetYearperiodToEdit($this->uri->segment(3));
			$this->mainCont = $this->load->view('pages/yearperiodform', $data, TRUE);
		} else {	
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/yearperiodform', $data, TRUE);	
		}			
	}

	#this will add new record
	public function addRecord() {
		if(empty($_POST['myear'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$addNew = $this->Contents->exeAddNewYearperiod();
			
			if($addNew['affRows'] > 0) {
				$_SESSION['disMsg'] = "Year period has been added.";
				redirect('yearperiod', 'location');			
			} else {
				$disMsg = "Unable to add new record.";
			}		
		}			
	}

	#this will display the form when editing the task
	public function updateInfo() {
		if(empty($_POST['myear'])) {		
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeUpdateYearperiod($this->uri->segment(3));
			
			if($saveinfo['affRows'] > 0) {
				$success = "Year period has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeleteYearperiod($this->uri->segment(3));		
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Year period record has been deleted.";
			redirect('yearperiod', 'location');			
		} else {
			$disMsg = "Unable to delete the sss record.";
		}			
		$this->mainCont = $this->load->view('pages/yearperiodlist', $data, TRUE);		 	
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