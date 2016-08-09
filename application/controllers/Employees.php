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

        redirect('login/login_form');
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
            $row[] = ucfirst($employee->firstname).' '.ucfirst(substr($employee->middlename,0,1)).'. '.ucfirst($employee->lastname);
            $row[] = $employee->position;
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

      public function add_employee()
    {
       
        $this->_validate();

        $data = array(
                'user_id' => $this->input->post('user_id'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'department' => $this->input->post('department'),
                'position' => $this->input->post('position'),
                'contact_no' => $this->input->post('contact_no'),
                'userlevel' => '3',
                'emp_pass' => md5($this->input->post('user_id')),
                'address' => $this->input->post('address'),
                'date_created' => '1996/10/10',
                'status' => '1',
             
                 
                
            );
   
        $insert = $this->employee->emp_save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function profile($id){


            $this->load->view('header');
            $data['image'] = $this->employee->get_image_profile($id);
             $data['exist'] = $this->employee->empinfo_count_all($id);
            $this->load->view('pages/profile', $data);
            $this->load->view('footer');
    }
      public function generate(){
        $month = date('M');
        $output = array(
                               
                                
                            "year" => date('Y'),
                            "month" => date('m',strtotime($month)),
                            "total" => $this->employee->emp_count_all()+1,
                        
                         
                    );
            //output to json format
            echo json_encode($output);

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
        $this->employee->emp_update(array('user_id' => $this->input->post('user_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

  public function basicinfo_list($id)
  {
        $data = $this->employee->emp_get_by_id($id);
        echo json_encode($data);
  }

  public function otherdetails_list($id)
  {
        $data = $this->employee->empinfo_get_by_id($id);
        echo json_encode($data);
  }

    public function add_otherdetails($id)
    {
     
        
        $data = array(
                'user_id' => $id,
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
        $insert = $this->employee->empinfo_save($data);
        echo json_encode(array("status" => TRUE));
    }

 public function update_otherdetails($id)
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
    $this->employee->empinfo_update(array('user_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }
  
     public function empsched_list($id)
    {
        $list = $this->employee->empsched_get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $employee) {
            $no++;
            $row = array();
             


$row[] = date("h:i A", strtotime($employee->mon_start)).' - '.date("h:i A", strtotime($employee->mon_end));
$row[] = date("h:i A", strtotime($employee->tue_start)).' - '.date("h:i A", strtotime($employee->tue_end));
$row[] = date("h:i A", strtotime($employee->wed_start)).' - '.date("h:i A", strtotime($employee->wed_end));
$row[] = date("h:i A", strtotime($employee->thurs_start)).' - '.date("h:i A", strtotime($employee->thurs_end));
$row[] = date("h:i A", strtotime($employee->fri_start)).' - '.date("h:i A", strtotime($employee->fri_end));
$row[] = date("h:i A", strtotime($employee->sat_start)).' - '.date("h:i A", strtotime($employee->sat_end));
$row[] = date("h:i A", strtotime($employee->sun_start)).' - '.date("h:i A", strtotime($employee->sun_end));

            

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
                    $data['image'] = $this->employee->get_image_profile($id);
                    $this->load->view('pages/profile', $data);
                    $this->load->view('footer');
                
                    
                }else{
    
                    $error = array('error' => $this->upload->display_errors());
                    $data['notif'] = $this->uploadinfo();
                     $this->load->view('header');
            $data['image'] = $this->employee->get_image_profile($id);
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

    public function get_session(){
        $data = array(
                'session_id' => $this->session->userdata('username'),
                
            );
        echo json_encode($data);
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