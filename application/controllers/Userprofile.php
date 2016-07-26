<?php
class Userprofile extends CI_Controller {
	var $pgToLoad;
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','profile');
		$this->load->library('form_validation');
	}


	public function index() {		
		 if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('login/login_form');
        }
        else{
       
			$this->load->helper('url');	
	        $this->load->view('header');
	        $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
			$data['status'] = $this->profile->exeGetUserStatus();
            $data['exist'] = $this->profile->empinfo_count_all($this->session->userdata('username'));
			$data['emp'] = $this->profile->exeGetEmpToEdit($this->session->userdata('username'));
			$data['info'] = $this->profile->exeGetUserInfo($this->session->userdata('username'));	
			$data['brandname'] = $this->profile->exeGetBrandToEdit($this->session->userdata('username'));
	        $this->load->view('pages/profile', $data);
			$this->load->view('footer');
	   }
	}	




  public function basicinfo_list()
  {
        $data = $this->profile->emp_get_by_id($this->session->userdata('username'));
        echo json_encode($data);
  }

   public function update_basicinfo()
    {
 
        $data = array(
                
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'department' => $this->input->post('department'),
                'position' => $this->input->post('position'),
                'contact_no' => $this->input->post('contact_no'),
                'address' => $this->input->post('address'),
               
                
            );
        $this->profile->emp_update(array('user_id' => $this->input->post('user_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

 public function otherdetails_list()
  {
        $data = $this->profile->empinfo_get_by_id($this->session->userdata('username'));
        echo json_encode($data);
  }

    public function add_otherdetails()
    {
     
        
        $data = array(
        		'user_id' => $this->session->userdata('username'),
        		'birthdate' => $this->input->post('birthdate'),
        		'gender' => $this->input->post('gender'),
                'datehired' => $this->input->post('datehired'),
        		'cstatus' => $this->input->post('cstatus'),
        		'hdmf_no' => $this->input->post('hdmf_no'),
                'tin_no' => $this->input->post('tin_no'),
                'sss_no' => $this->input->post('sss_no'),
                'philhealth_no' => $this->input->post('philhealth_no'),
                'salary' => 0,

                
                
            );
        $insert = $this->profile->empinfo_save($data);
        echo json_encode(array("status" => TRUE));
    }

 public function update_otherdetails()
    {
 
        $data = array(

          
                'birthdate' => $this->input->post('birthdate'),
                'gender' => $this->input->post('gender'),
                'datehired' => $this->input->post('datehired'),
                'cstatus' => $this->input->post('cstatus'),
                'hdmf_no' => $this->input->post('hdmf_no'),
                'tin_no' => $this->input->post('tin_no'),
                'sss_no' => $this->input->post('sss_no'),
                'philhealth_no' => $this->input->post('philhealth_no'),
               
                
            );
    $this->profile->empinfo_update(array('user_id' => $this->session->userdata('username')), $data);
        echo json_encode(array("status" => TRUE));
    }



		function do_upload(){
			if($this->input->post('upload')){

				$config['upload_path'] ='./uploads/';
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

	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('user_id') == '')
        {
              
            $data['inputerror'][] = 'user_id';
            $data['error_string'][] = 'User id is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('firstname') == '')
        {
            $data['inputerror'][] = 'firstname';
            $data['error_string'][] = 'first name is required';
            $data['status'] = FALSE;
        }

          if($this->input->post('middlename') == '')
        {
            $data['inputerror'][] = 'middlename';
            $data['error_string'][] = 'middle name is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('lastname') == '')
        {
            $data['inputerror'][] = 'lastname';
            $data['error_string'][] = 'last name is required';
            $data['status'] = FALSE;
        }
 

        if($this->input->post('department') == '')
        {
            $data['inputerror'][] = 'department';
            $data['error_string'][] = 'department is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('position') == '')
        {
            $data['inputerror'][] = 'position';
            $data['error_string'][] = 'position is required';
            $data['status'] = FALSE;
        }

          if($this->input->post('contact_no') == '')
        {
            $data['inputerror'][] = 'contact_no';
            $data['error_string'][] = 'contact no. is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'address is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


		
	
}
?>