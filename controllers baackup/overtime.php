<?php
class Overtime extends CI_Controller {
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
		$this->pgToLoad = empty($this->pgToLoad) ? "overtime" : $this->pgToLoad;
		$disMsg = "";

		#this will delete the record selected
		if($this->uri->segment(4) == 'delete') { 
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
		
		if($this->uri->segment(4) == 'add' || $this->uri->segment(4) == 'edit') {
			#this display the form for products
			$this->displayForm();
		} else {
			#this will display the job orders
			$this->displayOvertime();		
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
	
	public function displayOvertime() {
		if($this->uri->segment(2) == 'view') { 
			$data['employees'] = $this->Contents->exetGetOvertime($this->uri->segment(3));	
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/employeelist', $data, TRUE);
		} else {
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['payperiod'] = $this->Contents->exeGetPayperiod();
			$this->mainCont = $this->load->view('pages/overtimelist', $data, TRUE);
		}
	}

	#this will display the form when editing the product
	public function displayForm() {
		if($this->uri->segment(4) == 'edit') { 
			$data['emp'] = $this->Contents->exeGetMandatoryContriEdit($this->uri->segment(5));
			$data['ov'] = $this->Contents->exetGetOvertimeToEdit($this->uri->segment(3),$this->uri->segment(5));
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/overtimeform', $data, TRUE);
		} elseif($this->uri->segment(4) == 'add') {
			$data['emp'] = $this->Contents->exeGetEmployeeList();
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$this->mainCont = $this->load->view('pages/overtimeform', $data, TRUE);	
		} 			
	}

	#this will add new record
	public function addRecord() {
		if(empty($_POST['hours'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$addNew = $this->Contents->exeAddEmpOvertime();
			
			if($addNew['affRows'] > 0) {
				$_SESSION['disMsg'] = "Employees overtime has been added.";
				redirect('overtime/view/'.$this->uri->segment(3), 'location');			
			} else {
				$disMsg = "Unable to add new record.";
			}		
		}			
	}

	#this will display the form when editing the task
	public function updateInfo() {
		if(empty($_POST['hours'])) {		
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeUpdateEmpOvertime($this->uri->segment(3),$this->uri->segment(5));
			
			if($saveinfo['affRows'] > 0) {
				$success = "Overtime has been save.";
				$_SESSION['success'] = $success;	
				redirect('overtime/view/'.$this->uri->segment(3), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeleteOvertime($this->uri->segment(5));		
			
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Overtime record has been deleted.";
			redirect('overtime/view/'.$this->uri->segment(3), 'location');			
		} else {
			$disMsg = "Unable to delete the overtime record.";
		}		
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
		$data['employees'] = $this->Contents->exetGetOvertime($this->uri->segment(3));	
		$this->mainCont = $this->load->view('pages/employeelist', $data, TRUE);		 	
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