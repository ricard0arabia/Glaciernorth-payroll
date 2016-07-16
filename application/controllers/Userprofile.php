<?php
class Userprofile extends CI_Controller {
	var $pgToLoad;
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','profile');
	}


	public function view($id) {		
		 if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('login/login_form');
        }
        else{
       
			$this->load->helper('url');	
	        $this->load->view('header');
	        $data['image'] = $this->profile->get_image_profile($id);
			$data['status'] = $this->profile->exeGetUserStatus();
			$data['emp'] = $this->profile->exeGetEmpToEdit($id);
			$data['info'] = $this->profile->exeGetUserInfo($id);	
	        $this->load->view('pages/profile', $data);
			$this->load->view('footer');
	   }
	}	
	
	


		function do_upload(){
			if($this->input->post('upload')){

				$config['upload_path'] ='./uploads/';;
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']    = '20240';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$this->load->library('upload', $config);
			
        	$userfile = "userfile";

				if ( $this->upload->do_upload($userfile)){
					
					$data=$this->upload->data();
					$this->thumb($data);
					$file=array(
					'img_name'=>$data['raw_name'],
					'thumb_name'=>$data['raw_name'].'_thumb',
					'ext'=>$data['file_ext'],
					'upload_date'=>time()
					);
					$this->profile->add_image($file,$this->session->userdata('username'));
					$data = array('upload_data' => $this->upload->data());

					$data['notif'] = $this->uploadinfo();
					$data['level'] = $this->profile->exeGetUserLevel();
					 
			        $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
					$data['status'] = $this->profile->exeGetUserStatus();
					$data['emp'] = $this->profile->exeGetEmpToEdit($this->session->userdata('username'));
					$data['info'] = $this->profile->exeGetUserInfo($this->session->userdata('username'));	
					$this->load->view('header');
			        $this->load->view('pages/profile', $data);
					$this->load->view('footer');
				
					
				}else{
	
					$error = array('error' => $this->upload->display_errors());
					$data['notif'] = $this->uploadinfo();
					 $this->load->view('header');
	        $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
			$data['status'] = $this->profile->exeGetUserStatus();
			$data['emp'] = $this->profile->exeGetEmpToEdit($this->session->userdata('username'));
			$data['info'] = $this->profile->exeGetUserInfo($this->session->userdata('username'));	
	        $this->load->view('pages/profile', $data);
			$this->load->view('footer');
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
		
	
}
?>