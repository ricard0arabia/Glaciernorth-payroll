<?php
class Mandatory extends CI_Controller {
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
		
		if(isset($_POST['cmd'])) {			
			for($i=1;$i<=$_POST['i'];$i++) {				
				if(isset($_POST['ch'.$i]) && $_POST['ch'.$i]>0) {
					$delAds = $this->Contents->exeDeleteEmp($_POST['ch'.$i]);							
				}						
			}
			if($delAds['affRows'] > 0) {
				$_SESSION['disMsg'] = "Employee corner content has been deleted.";
				redirect('employees', 'location');			
			} else {
				$disMsg = "Unable to delete the employee corner content.";
			}				
		}	
		
		if($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit') {
			#this display the form for products
			$this->displayForm();
		} else {
			#this will display the job orders
			$this->getMandatory();		
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
	
	public function getMandatory() {
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$data['mandatory'] = $this->Contents->exeGetMandatoryContri();
		$this->mainCont = $this->load->view('pages/mandatorylist', $data, TRUE);
	}

	#this will display the form when editing the product
	public function displayForm() {
		if($this->uri->segment(2) == 'edit') {
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['emp'] = $this->Contents->exeGetEmpToEdit($this->uri->segment(3)); 
			$data['mandatory'] = $this->Contents->exeGetMandatoryContriEdit($this->uri->segment(3));
			$this->mainCont = $this->load->view('pages/mandatoryform', $data, TRUE);
		} else {
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['emp'] = $this->Contents->exeGetEmployeeList();	
			//$data['mandatory'] = $this->Contents->exeGetMandatoryContri();	
			$this->mainCont = $this->load->view('pages/mandatoryform', $data, TRUE);	
		}			
	}

	#this will add new record
	public function addRecord() {
		if(empty($_POST['status'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$addNew = $this->Contents->exeAddEmpContri();
			
			if($addNew['affRows'] > 0) {
				$_SESSION['disMsg'] = "Employees contributions has been added.";
				redirect('mandatory', 'location');			
			} else {
				$disMsg = "Unable to add new record.";
			}		
		}			
	}

	#this will display the form when editing the task
	public function updateInfo() {
		if(empty($_POST['pagibig']) || empty($_POST['philhealth'])) {		
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeUpdateEmpContri($this->uri->segment(3));
			
			if($saveinfo['affRows'] > 0) {
				$success = "Employees contributions has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeleteEmpContri($this->uri->segment(3));		
		//$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Employee contribution has been deleted.";
			redirect('mandatory', 'location');			
		} else {
			$disMsg = "Unable to delete this record.";
		}			
		//$this->mainCont = $this->load->view('pages/mandatorylist', $data, TRUE);		 	
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