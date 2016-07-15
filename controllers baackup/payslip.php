<?php
class Payslip extends CI_Controller {
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
		
		if($this->uri->segment(5) != '' || $this->uri->segment(4) == 'edit') {
			#this display the form for pay slip
			$this->displayForm();
		} else {
			#this will display the pay slip
			$this->getPayslip();		
		}	

		if($this->uri->segment(5) != '' || $this->uri->segment(4) == 'print') {
			#this display the form for pdf
			$this->pdf();
		} else {
			#this will display the pay slip
			$this->getPayslip();		
		}		

		if($this->uri->segment(3) != '' || $this->uri->segment(2) == 'print') {
			#this display the form for pdf
			$this->pdf();
		} else {
			#this will display the pay slip
			$this->getPayslip();		
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
	
	public function getPayslip() {
	if($this->uri->segment(2) != 'print') { 
		if($this->uri->segment(2) == 'view') { 

			if($this->uri->segment(4) == 'addnew') {
				$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
				$data['employees'] = $this->Contents->exeGetEmployeeList();	
				$this->mainCont = $this->load->view('pages/emplist', $data, TRUE);
			} else {
				$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
				$data['employees'] = $this->Contents->exeGetPayslip($this->uri->segment(3));
				$this->mainCont = $this->load->view('pages/employeelist', $data, TRUE);	
			} 
		} else {
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['payperiod'] = $this->Contents->exeGetPayperiod();
			$this->mainCont = $this->load->view('pages/paysliplist', $data, TRUE);
		}
	}
	}




	/*this will display the pdf*/
	function pdf()
	{
			if($this->uri->segment(4) == 'print' ) { 
    		$this->load->helper('pdf_helper');
			$data['ov'] = $this->Contents->exeGetPayslip($this->uri->segment(3));
    		$this->load->view('pdfreport',$data);
		}
			else if($this->uri->segment(2) == 'print' ) { 
				$this->load->helper('pdf_helper');
				$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
				$data['ov'] = $this->Contents->exeGetPayslip($this->uri->segment(3));
			
				   $this->load->view('pdfreport',$data);
			}
	}
	#this will display the form when editing the product
	public function displayForm() {
		
		if($this->uri->segment(4) == 'edit' || $this->uri->segment(4) == 'addnew') { 
			$data['payperiod'] = $this->Contents->exeGetPayperiodToEdit($this->uri->segment(3));
			$data['emp2'] = $this->Contents->exeGetMandatoryContriEdit($this->uri->segment(5));
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
			$data['tax'] = $this->Contents->exeGetBirTax();
			$data['emp'] = $this->Contents->exeGetEmpToEdit($this->uri->segment(5));
			$data['contri'] = $this->Contents->getContributions($this->uri->segment(5));
			$data['ot'] = $this->Contents->exetGetOvertime($this->uri->segment(3));
			$data['ab'] = $this->Contents->exetGetAbsences($this->uri->segment(3));
			$data['ov'] = $this->Contents->exeGetPayslip($this->uri->segment(3),$this->uri->segment(5));
			$this->mainCont = $this->load->view('pages/payslipform', $data, TRUE);
		} 			
	}

	#this will add new record
	public function addRecord() {
		if(empty($_POST['netpay2'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$addNew = $this->Contents->exeAddPaySlip();
			
			if($addNew['affRows'] > 0) {
				$_SESSION['disMsg'] = "Pay period has been added.";
				redirect('payslip/view/'.$this->uri->segment(3), 'location');			
			} else {
				$disMsg = "Unable to add new record.";
			}		
		}			
	}

	#this will display the form when editing the task
	public function updateInfo() {
		if(empty($_POST['payfrom']) || empty($_POST['payfrom'])) {		
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeUpdatePayperiod($this->uri->segment(3));
			
			if($saveinfo['affRows'] > 0) {
				$success = "Pay period has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save record.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeletePayslip($this->uri->segment(5));		
			$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Payslip record has been deleted.";
			redirect('payslip/view/'.$this->uri->segment(3), 'location');			
		} else {
			$disMsg = "Unable to delete the payslip record.";
		}			
		$data['payperiod'] = $this->Contents->exeGetPayperiod();
		$this->mainCont = $this->load->view('pages/paysliplist', $data, TRUE); 	
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