<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		#this will start the session
		session_start();
		
		if(!isset($_SESSION['userId']) || !isset($_SESSION['userLevel']) || !isset($_SESSION['employeeid']) || !isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
			redirect('home', 'location');
		}
		
		#this will load the model
		$this->load->model('Contents','leave');
	}

	public function index() {	
		$this->load->helper('url');	
          $this->load->view('header');
          $this->load->view('pages/requests/leave');
		  $this->load->view('footer');
	
	}	

             public function ajax_list()
    {
        $list = $this->leave->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $leave) {
            $no++;
            $row = array();
            $row[] = $leave->id;
             $row[] = $leave->user_id;
            $row[] = $leave->startdate;
            $row[] = $leave->enddate;
             $row[] = $leave->duration;
             $row[] = $leave->status; 
             $row[] = $leave->cause;
              $row[] = $leave->leavetype;
           
            
                
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_leave('."'".$leave->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_leave('."'".$leave->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
         
          
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->leave->count_all(),
                        "recordsFiltered" => $this->leave->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	#this will display the form when editing the product
	public function leave() {
		
	
		$data['employee'] = $this->leave->exeGetEmpToEdit($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/requests/leave', '', TRUE);	
		
	}

	public function overtime() {
		
		$data['employee'] = $this->leave->exeGetEmpToEdit($_SESSION['userId']);	
			$this->mainCont = $this->load->view('pages/requests/overtime', '', TRUE);	
		
	}

	public function shift() {
	
		$data['employee'] = $this->leave->exeGetEmpToEdit($_SESSION['userId']);	
		$this->mainCont = $this->load->view('pages/requests/shiftchange', '', TRUE);	
			
	}


	public function add_leave()
    {
        $this->_validate();
        $data = array(
        		'user_id' => $_SESSION['userId'],
        		'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
        		'leavetype' => $this->input->post('leavetype'),
        		'status' => '1',
                'cause' => $this->input->post('cause'),
                'duration' => $this->input->post('duration'),
                
                
            );
        $insert = $this->leave->save($data);
        echo json_encode(array("status" => TRUE));
    }

     public function edit_leave($id)
    {
        $data = $this->leave->get_by_id($id);
        $data->startdate = ($data->startdate == '0000-00-00') ? '' : $data->startdate; 
        $data->enddate = ($data->enddate == '0000-00-00') ? '' : $data->enddate; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 

    public function update_leave()
    {
        $this->_validate();
        $data = array(
              	'user_id' => $_SESSION['userId'],
        		'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
        		'leavetype' => $this->input->post('leavetype'),
        		'status' => '1',
                'cause' => $this->input->post('cause'),
                'duration' => $this->input->post('duration'),
            );
        $this->leave->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
   public function delete_leave($id)
    {
        $this->leave->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 

	   private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		if($this->input->post('leavetype') == '')
        {
            $data['inputerror'][] = 'leavetype';
            $data['error_string'][] = 'Please select type';
            $data['status'] = FALSE;
        }
 
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
 

        if($this->input->post('cause') == '')
        {
            $data['inputerror'][] = 'cause';
            $data['error_string'][] = 'Cause is required';
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