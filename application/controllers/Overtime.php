<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('Contents','overtime');
    }

    public function request() { 

        if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{

        $this->load->helper('url'); 
          $this->load->view('header');
          $data['user'] = $this->session->userdata('username');
           $data['name'] = $this->overtime->emp_get_name($this->session->userdata('username'));   
          $this->load->view('pages/requests/overtime',$data);
          $this->load->view('footer');
        }
    
    }   

    public function approval() { 

        if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{

        $this->load->helper('url'); 
          $this->load->view('header');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/approvals/overtime',$data);
          $this->load->view('footer');
        }
    
    }   

             public function request_list()
    {

        $list = $this->overtime->ot_rqst_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $overtime) {

             $class = 'label label-success';
        if ($overtime->ot_status == 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = date("F j,Y", strtotime($overtime->date));
             $row[] = $overtime->duration." hrs";
             $row[] = $overtime->cause;
             $row[] = '<h4><span class="'.$class.'">'.$overtime->ot_status.'</span></h4>'; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_overtime('."'".$overtime->overtime_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_overtime('."'".$overtime->overtime_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

     public function request_history_list()
    {
        $list = $this->overtime->ot_request_history_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $overtime) {
            $class = 'label label-success';
        if ($overtime->ot_status === 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = date("F j,Y", strtotime($overtime->date));
             $row[] = $overtime->duration." hrs";
             $row[] = $overtime->cause;
             $row[] = date("F j,Y", strtotime($overtime->date_submitted));
            $row[] = date("F j,Y", strtotime($overtime->date_approved));
               $row[] = '<h4><span class="'.$class.'">'.$overtime->ot_status.'</span></h4>';  
           
          

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
                'user_id' => $this->session->userdata('username'),
                'date' => $this->input->post('date'),
                'ot_status' => 'requested',
                'cause' => $this->input->post('cause'),
                'duration' => $this->input->post('duration'),
                
                
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
                'user_id' => $this->session->userdata('username'),
                'date' => $this->input->post('date'),
                'ot_status' => 'requested',
                'cause' => $this->input->post('cause'),
                'duration' => $this->input->post('duration'),
            );
        $this->overtime->ot_update(array('overtime_id' => $this->input->post('id')), $data);
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

// approval
//
//

     public function approval_list()
    {
        $list = $this->overtime->ot_approval_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $overtime) {
              $class = 'label label-success';
        if ($overtime->ot_status == 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = $overtime->lastname;
            $row[] = $overtime->position;
            $row[] = $overtime->department;
            $row[] = date("F j,Y", strtotime($overtime->date));
             $row[] = $overtime->duration." hrs";
             $row[] = $overtime->cause;
             $row[] = '<h4><span class="'.$class.'">'.$overtime->ot_status.'</span></h4>'; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="accept_overtime('."'".$overtime->user_id."'".')">Accept</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="decline_overtime('."'".$overtime->overtime_id."'".')">Decline</a>';

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

     public function accept_overtime($id)
    {
        
        $data = array(
                
                'ot_status' => 'approved',
                'date_approved' => date("Y-m-d"),
                
            );
        $this->overtime->ot_update(array('user_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }



    public function approval_history_list()
    {
        $list = $this->overtime->ot_approval_history_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $overtime) {
              $class = 'label label-success';
        if ($overtime->ot_status == 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = $overtime->lastname;
            $row[] = $overtime->position;
            $row[] = $overtime->department;
            $row[] = date("F j,Y", strtotime($overtime->date));
             $row[] = $overtime->duration." hrs";
             $row[] = $overtime->cause;
             $row[] = date("F j,Y", strtotime($overtime->date_submitted));
            $row[] = date("F j,Y", strtotime($overtime->date_approved));
             $row[] = '<h4><span class="'.$class.'">'.$overtime->ot_status.'</span></h4>'; 
           
          

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



    
}
?>