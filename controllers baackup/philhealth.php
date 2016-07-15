<?php
class Philhealth extends CI_Controller {
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
			$this->getPhilhealthList();		
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
	
	public function getPhilhealthList() {
		$data['philhealthlist'] = $this->Contents->exeGetPhilhealth();
		$this->mainCont = $this->load->view('pages/philhealthlist', $data, TRUE);
	}

	#this will display the form when editing the product
	public function displayForm() {
		if($this->uri->segment(2) == 'edit') { 
			$data['philhealth_table'] = $this->Contents->exeGetPhilhealthToEdit($this->uri->segment(3));
			$this->mainCont = $this->load->view('pages/philhealthform', $data, TRUE);
		} else {		
			$this->mainCont = $this->load->view('pages/philhealthform', '', TRUE);	
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
				$_SESSION['disMsg'] = "New Philhealth Contribution has been added.";
				redirect('philhealth', 'location');			
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
			$saveinfo = $this->Contents->exeUpdatePhilhealthRecord($this->uri->segment(3));
			
			if($saveinfo['affRows'] > 0) {
				$success = "Philhealth Contribution has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeletePhilhealthRecord($this->uri->segment(3));		
			
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Philhealth record has been deleted.";
			redirect('philhealth', 'location');			
		} else {
			$disMsg = "Unable to delete the Philhealth record.";
		}			
		$this->mainCont = $this->load->view('pages/philhealthlist', $data, TRUE);		 	
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