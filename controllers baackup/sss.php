<?php
class Sss extends CI_Controller {
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
			$this->getSSSList();		
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
	
	public function getSSSList() {
		$data['ssslist'] = $this->Contents->exeGetSSS();
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$this->mainCont = $this->load->view('pages/ssslist', $data, TRUE);
	}

	#this will display the form when editing the product
	public function displayForm() {
		if($this->uri->segment(2) == 'edit') { 
			$data['sss'] = $this->Contents->exeGetSSSToEdit($this->uri->segment(3));
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/sssform', $data, TRUE);
		} else {		
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/sssform', '', TRUE);	
		}			
	}

	#this will add new record
	public function addRecord() {
		if(empty($_POST['minsal']) || empty($_POST['empshare']) || empty($_POST['total']) || empty($_POST['maxsal']) || empty($_POST['empshare'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$addNew = $this->Contents->exeAddNewSSS();
			
			if($addNew['affRows'] > 0) {
				$_SESSION['disMsg'] = "New SSS Contribution has been added.";
				redirect('sss', 'location');			
			} else {
				$disMsg = "Unable to add new record.";
			}		
		}			
	}

	#this will display the form when editing the task
	public function updateInfo() {
		if(empty($_POST['minsal']) || empty($_POST['empshare']) || empty($_POST['total']) || empty($_POST['maxsal']) || empty($_POST['empshare'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeUpdateSSSRecord($this->uri->segment(3));
			
			if($saveinfo['affRows'] > 0) {
				$success = "SSS Contribution has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeleteSSSRecord($this->uri->segment(3));		
			
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "SSS record has been deleted.";
			redirect('sss', 'location');			
		} else {
			$disMsg = "Unable to delete the sss record.";
		}		
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
		$this->mainCont = $this->load->view('pages/ssslist', $data, TRUE);		 	
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