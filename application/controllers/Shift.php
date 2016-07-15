<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','shift');
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
          $this->load->view('pages/requests/shiftchange',$data);
		  $this->load->view('footer');
        }
	
	}	

             public function shift_list()
    {
        $list = $this->shift->shift_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $shift) {
            $no++;
            $row = array();
$row[] = date("h:i A", strtotime($shift->mon_start)).' - '.date("h:i A", strtotime($shift->mon_end))."<br><strong>to</strong>";
$row[] = date("h:i A", strtotime($shift->tue_start)).' - '.date("h:i A", strtotime($shift->tue_end));
$row[] = date("h:i A", strtotime($shift->wed_start)).' - '.date("h:i A", strtotime($shift->wed_end));
$row[] = date("h:i A", strtotime($shift->thurs_start)).' - '.date("h:i A", strtotime($shift->thurs_end));
$row[] = date("h:i A", strtotime($shift->fri_start)).' - '.date("h:i A", strtotime($shift->fri_end));
$row[] = date("h:i A", strtotime($shift->sat_start)).' - '.date("h:i A", strtotime($shift->sat_end));
$row[] = date("h:i A", strtotime($shift->sun_start)).' - '.date("h:i A", strtotime($shift->sun_end));
             $row[] = $shift->startdate;
             $row[] = $shift->enddate;
             $row[] = $shift->reason;
             $row[] = $shift->sub_department;
             $row[] = $shift->sub_position; 
             $row[] = $shift->sub_id;
            
            
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_shift('."'".$shift->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_shift('."'".$shift->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->shift->shift_count_all(),
                        "recordsFiltered" => $this->shift->shift_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

        public function emp_list()
    {
        $list = $this->shift->emp_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $shift) {
            $no++;
            $row = array();

            $row[] = $shift->user_id;
            $row[] = $shift->lastname;
             $row[] = $shift->jobtitle;
              $row[] = $shift->department;
             


$row[] = date("h:i A", strtotime($shift->mon_start)).' - '.date("h:i A", strtotime($shift->mon_end));
$row[] = date("h:i A", strtotime($shift->tue_start)).' - '.date("h:i A", strtotime($shift->tue_end));
$row[] = date("h:i A", strtotime($shift->wed_start)).' - '.date("h:i A", strtotime($shift->wed_end));
$row[] = date("h:i A", strtotime($shift->thurs_start)).' - '.date("h:i A", strtotime($shift->thurs_end));
$row[] = date("h:i A", strtotime($shift->fri_start)).' - '.date("h:i A", strtotime($shift->fri_end));
$row[] = date("h:i A", strtotime($shift->sat_start)).' - '.date("h:i A", strtotime($shift->sat_end));
$row[] = date("h:i A", strtotime($shift->sun_start)).' - '.date("h:i A", strtotime($shift->sun_end));

            
    
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="add" onclick="add_shift('."'".$shift->user_id."'".')"><i class="glyphicon glyphicon-plus"></i>Add Shift</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->shift->emp_count_all(),
                        "recordsFiltered" => $this->shift->emp_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


      public function add_shift($id)
        {
            $data = $this->shift->emp_get_by_id($id);   
            echo json_encode($data);
        }
     

	public function save_shift()
    {

  
        $data = array(

        		'user_id' => $this->session->userdata('username'),
        		'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'duration' => $this->input->post('duration'),
                'reason' => $this->input->post('reason'),
        		'status' => 'requested',
                'shift_days' => 'asdasd',
                'sub_department' => 'asd',
                'sub_position' => 'qwerty',             
                'sub_id' => $this->input->post('sub_id'),           
                'mon_start' => '20:00:00',
                'mon_end' => '20:00:00',
                'tue_start' =>'20:00:00',
                'tue_end' => '20:00:00',
                'wed_start' => '20:00:00',
                'wed_end' => '20:00:00',
                'thurs_start' => '20:00:00',
                'thurs_end'=> '20:00:00',
                'fri_start' => '20:00:00',
                'fri_end' =>'20:00:00',
                'sat_start' => '20:00:00',
                'sat_end' => '20:00:00',
                'sun_start' => '20:00:00',
                'sun_end' => '20:00:00',
                            
                
            );
       $insert = $this->shift->shift_save($data);
        echo json_encode(array("status" => TRUE));
    }

 
 
   public function delete_shift($id)
    {
        $this->shift->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 

	   private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
 
        if($this->input->post('startdate') == '')
        {
            $data['inputerror'][] = 'startdate';
            $data['error_string'][] = 'Start date is required';
            $data['status'] = FALSE;
        }

          if($this->input->post('enddate') == '')
        {
            $data['inputerror'][] = 'enddate';
            $data['error_string'][] = 'End date is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('duration') == '')
        {
            $data['inputerror'][] = 'duration';
            $data['error_string'][] = 'duration is required';
            $data['status'] = FALSE;
        }
 

        if($this->input->post('reason') == '')
        {
            $data['inputerror'][] = 'reason';
            $data['error_string'][] = 'reason is required';
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