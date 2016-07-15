<?php
class Userprofile extends CI_Controller {
	var $pgToLoad;
	
	public function __construct() {
		parent::__construct();
		#this will start the session
		session_start();
			$this->load->helper(array('form', 'url'));
		
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

		if($this->input->post('upload')){

			$this->uploadinfo();
			$this->do_upload();
		}

		if($this->uri->segment(2) == "edit"){


		}
		else{

			$this->profile();

		}

		#set default content to load 
		$this->pgToLoad = empty($this->pgToLoad) ? "userprofile" : $this->pgToLoad;
		$disMsg = "";
		
		
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

	#this will display the form when editing the product
	public function profile() {
		$data['image'] = $this->Contents->get_image_profile($_SESSION['userId']);

		$data['level'] = $this->Contents->exeGetUserLevel();	
		$data['employee'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$data['emp'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
		$data['info'] = $this->Contents->exeGetUserInfo($_SESSION['userId']);	
		$this->mainCont = $this->load->view('pages/profile', $data, TRUE);			
	}

	#this will display the form when editing the product
	public function updateInfo() {
		if(empty($_POST['fname']) || empty($_POST['mname']) || empty($_POST['lname']) || empty($_POST['emailadd']) || empty($_POST['gender'])) {	
			$disMsg = "Please fill up the form completely.";
			$_SESSION['disMsg'] = $disMsg;	
		} else {
			$saveinfo = $this->Contents->exeSaveUserInfo($_SESSION['userId']);
			
			if($saveinfo['affRows'] > 0) {
				$success = "Employee information has been save.";
				$_SESSION['success'] = $success;	
				redirect($this->uri->segment(1), 'location');			
			} else {
				$disMsg = "Unable to save information.";
			}		
		}			
	}

	#this will delete the employees record
	public function deleteRecord() {		
		$delete = $this->Contents->exeDeleteRecord($this->uri->segment(3));		
			
		if($delete['affRows'] > 0) {
			$_SESSION['success'] = "Employee record has been deleted.";
			redirect('employees', 'location');			
		} else {
			$disMsg = "Unable to delete the employee record.";
		}			
		$this->mainCont = $this->load->view('pages/employees', $data, TRUE);		 	
	}



		function do_upload(){
			if($this->input->post('upload')){

				$config['upload_path'] = './uploads/';
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']    = '2048';
				$config['max_width']  = '3000';
				$config['max_height']  = '1000';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload()){

					$error = array('error' => $this->upload->display_errors());
					$data['notif'] = $this->uploadinfo();
					$data['level'] = $this->Contents->exeGetUserLevel();
				$data['image'] = $this->Contents->get_image_profile($_SESSION['userId']);
					$data['status'] = $this->Contents->exeGetUserStatus();
					$data['emp'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
					$data['info'] = $this->Contents->exeGetUserInfo($_SESSION['userId']);	
					$this->mainCont = $this->load->view('pages/profile', $data, TRUE);	
					
				}else{
					$data=$this->upload->data();
					$this->thumb($data);
					$file=array(
					'img_name'=>$data['raw_name'],
					'thumb_name'=>$data['raw_name'].'_thumb',
					'ext'=>$data['file_ext'],
					'upload_date'=>time()
					);
					$this->Contents->add_image($file,$_SESSION['userId']);
					$data = array('upload_data' => $this->upload->data());

					$data['notif'] = $this->uploadinfo();
					$data['level'] = $this->Contents->exeGetUserLevel();
					$data['image'] = $this->Contents->get_image($_SESSION['userId']);
					$data['status'] = $this->Contents->exeGetUserStatus();
					$data['emp'] = $this->Contents->exeGetEmpToEdit($_SESSION['userId']);
					$data['info'] = $this->Contents->exeGetUserInfo($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/profile', $data, TRUE);		
				}
			
			}
			else{

				redirect(site_url('employees'));
				}
			}

	function thumb($data){
				$config['image_library'] = 'gd2';
				$config['source_image'] =$data['full_path'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 275;
				$config['height'] = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				}
				
	public function uploadinfo(){
		
		if (empty($_FILES['userfile']['name'])) {
			$notif = "please select an image";
			return $notif;
			}	
		else{

			$notif = "image upload successful";
			return $notif;
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