<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
			
		#this will load the model
		$this->load->model('Contents','overtime');
	}

	public function index() {	

         if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{

       
		  $this->load->helper('url');	
          $this->load->view('header');
          $this->load->view('pages/requests/overtime');
		  $this->load->view('footer');
	   }
	}	

             public function ajax_list()
    {
        $list = $this->overtime->ot_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $overtime) {
            $no++;
            $row = array();
            $row[] = $overtime->id;
            $row[] = $overtime->date;
             $row[] = $overtime->duration;
             $row[] = $overtime->cause; 
             $row[] = $overtime->status;

           
            
                
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_overtime('."'".$overtime->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_overtime('."'".$overtime->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
         
          
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->overtime->ot_count_all(),
                        "recordsFiltered" => $this->overtime->ot_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	public function add_overtime()
    {
        $this->_validate();
        $data = array(
        		'user_id' =>$this->session->userdata('username'),
                'date' => $this->input->post('date'),
                'duration' => $this->input->post('duration'),
                'cause' => $this->input->post('cause'),
                'status' => $this->input->post('status'),
                
                
            );
        $insert = $this->overtime->ot_save($data);
        echo json_encode(array("status" => TRUE));
    }

     public function edit_overtime($id)
    {
        $data = $this->overtime->ot_get_by_id($id);
        $data->date = ($data->date == '0000-00-00') ? '' : $data->date; 
        echo json_encode($data);
    }
 

    public function update_overtime()
    {
        $this->_validate();
        $data = array(
              'user_id' =>$this->session->userdata('username'),
                'date' => $this->input->post('date'),
                'duration' => $this->input->post('duration'),
                'cause' => $this->input->post('cause'),
                'status' => $this->input->post('status'),
            );
        $this->overtime->ot_update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
   public function delete_overtime($id)
    {
        $this->overtime->ot_delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 

	   private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
	
 
        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('duration') == '')
        {
            $data['inputerror'][] = 'duration';
            $data['error_string'][] = 'Duration is required';
            $data['status'] = FALSE;
        }
 

        if($this->input->post('cause') == '')
        {
            $data['inputerror'][] = 'cause';
            $data['error_string'][] = 'Cause is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }
 
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

//Logout
    public function logout(){
    session_destroy();
            redirect('logout', 'location');
        }





	
}
?>