<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','employee');
	}

	public function index() {	

        if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{

		$this->load->helper('url');	
          $this->load->view('header');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/employees',$data);
		  $this->load->view('footer');
        }
	
	}	

             public function ajax_list()
    {
        $list = $this->employee->emp_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $employee) {
            $no++;
            $row = array();
            $row[] = '<img height="60" width="60" src="'.base_url().'uploads/'.$employee->thumb_name.$employee->ext.'">';

     	  	$row[] = $employee->user_id;
            $row[] = $employee->lastname;
            $row[] = $employee->jobtitle;
            $row[] = $employee->department;
            $row[] = $employee->contact_no;
            $row[] = $employee->address;
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('employees/profile/'.$employee->user_id).'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_employee('."'".$employee->user_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->employee->emp_count_all(),
                        "recordsFiltered" => $this->employee->emp_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function profile($id){


            $this->load->view('header');
            $data['image'] = $this->employee->get_image_profile($id);
            $data['status'] = $this->employee->exeGetUserStatus();
            $data['emp'] = $this->employee->exeGetEmpToEdit($id);
            $data['info'] = $this->employee->exeGetUserInfo($id);    
            $data['brandname'] = $this->employee->exeGetBrandToEdit($id);
            $this->load->view('pages/profile', $data);
            $this->load->view('footer');
    }



 function branddetailsinsert($id)
 {
 
  $insertstatus = $this->employee->insertbranddetials($id);
  if($insertstatus)
  {
  echo "Success";
  }
}



        function do_upload($id){
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
                    $this->employee->add_image($file,$id);
                    $data = array('upload_data' => $this->upload->data());

                    $data['notif'] = $this->uploadinfo();
                    $data['level'] = $this->employee->exeGetUserLevel();
                     
                    $data['image'] = $this->employee->get_image_profile($id);
                    $data['status'] = $this->employee->exeGetUserStatus();
                    $data['emp'] = $this->employee->exeGetEmpToEdit($id);
                    $data['info'] = $this->employee->exeGetUserInfo($id);   
                    $this->load->view('header');
                    $this->load->view('pages/profile', $data);
                    $this->load->view('footer');
                
                    
                }else{
    
                    $error = array('error' => $this->upload->display_errors());
                    $data['notif'] = $this->uploadinfo();
                     $this->load->view('header');
            $data['image'] = $this->employee->get_image_profile($id);
            $data['status'] = $this->employee->exeGetUserStatus();
            $data['emp'] = $this->employee->exeGetEmpToEdit($id);
            $data['info'] = $this->employee->exeGetUserInfo($id);   
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