<?php
class Settings extends CI_Controller {
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
		$this->pgToLoad = empty($this->pgToLoad) ? "settings" : $this->pgToLoad;
		$disMsg = "";
		
		#this will delete the record selected
		if($this->uri->segment(2) == 'delete') { 
			$this->deleteRecord();
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
		
		#this will display the account details of the user	
		$this->displayForm();
		
		#this will logout the user and redirect to the page
		if($this->uri->segment(2) == 'logout') {
			session_destroy();
			redirect('home', 'location');
		}					
		
		$data = array ( 'pageTitle' => 'Glacier Payroll | ADMINISTRATION',
						'disMsg'	=> $disMsg,												
						'mainCont'	=> $this->mainCont );
		
		$this->load->view('mainTpl', $data, FALSE);
	}

	#this will display the form when updating password
	public function displayForm() {
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$data['info'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);	
		$this->mainCont = $this->load->view('pages/passwordform', $data, TRUE);			
	}

	#this will display the form when editing the product
	public function updateInfo() {
		if(empty($_POST['empass']) || empty($_POST['newPass'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			if($_POST['newPass'] != $_POST['empass']) {
				$disMsg = "Password not matched.";
				$_SESSION['disMsg'] = $disMsg;				
			} else {
				$saveinfo = $this->Contents->exeUpdatePassword($_SESSION['userId']);
				
				if($saveinfo['affRows'] > 0) {
					$success = "Password has been save.";
					$_SESSION['success'] = $success;	
					redirect($this->uri->segment(1), 'location');			
				} else {
					$disMsg = "Unable to change password.";
				}
			}		
		}			
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