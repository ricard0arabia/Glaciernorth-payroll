<?php



class Leave extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('Contents','leave');
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
        $data['name'] = $this->leave->emp_get_name($this->session->userdata('username'));   
          $this->load->view('pages/requests/leave',$data);

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
          $data['name'] = $this->leave->emp_get_name($this->session->userdata('username'));
          $this->load->view('pages/approvals/leave',$data);
          $this->load->view('footer');
        }
    
    }   

             public function request_list()
    {




        $list = $this->leave->rqst_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $leave) {

             $class = 'label label-success';
        if ($leave->leave_status === 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
        $row[] = $leave->leavetype;
            $row[] = date("F j,Y", strtotime($leave->startdate));
            $row[] = date("F j,Y", strtotime($leave->enddate));
             $row[] = $leave->duration;
             $row[] = $leave->cause;
             $row[] = '<h4><span class="'.$class.'">'.$leave->leave_status.'</span></h4>'; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_leave('."'".$leave->leave_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_leave('."'".$leave->leave_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

     public function request_history_list()
    {
        $list = $this->leave->leave_request_history_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $leave) {
            $class = 'label label-success';
        if ($leave->leave_status === 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = $leave->leavetype;
            $row[] = date("F j,Y", strtotime($leave->startdate));
            $row[] = date("F j,Y", strtotime($leave->enddate));
             $row[] = $leave->duration;
             $row[] = $leave->cause;
             $row[] = date("F j,Y", strtotime($leave->date_submitted));
            $row[] = date("F j,Y", strtotime($leave->date_approved));
               $row[] = '<h4><span class="'.$class.'">'.$leave->leave_status.'</span></h4>';  
           
          

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



    public function add_leave()
    {
            $this->_validate();

            $count = $this->leave->count_all($this->session->userdata('username'));
            $date_now = date('Y-m-d');

            $dates = $this->leave->get_leave_date($this->session->userdata('username'));

            if($count == 0 || $date_now > $dates->enddate){

            $list = $this->leave->get_sched($this->session->userdata('username'));
            $start = false;
            $end = false;

             foreach ($list as $value) {
            $datetime = date_create($value->start);
            $date = date_format($datetime,"Y-m-d");
                if($this->input->post('startdate') == $date){
                    if($value->work_status != 'active'){

                        $start = false;
                        break;

                    }else{
                    $start = true;
                    break;
                    }
                }
           }

            foreach ($list as $value) {
            $datetime = date_create($value->start);
            $date = date_format($datetime,"Y-m-d");

                if($this->input->post('enddate') == $date){
                    if($value->work_status != 'active'){

                        $end = false;
                        break;

                    }else{

                    $end = true;
                    break;
                    }
                }
           }
             if($start == true && $end == true){
            $data = array(
                    'user_id' => $this->session->userdata('username'),
                    'startdate' => $this->input->post('startdate'),
                    'enddate' => $this->input->post('enddate'),
                    'leavetype' => $this->input->post('leavetype'),
                    'leave_status' => 'requested',
                    'cause' => $this->input->post('cause'),
                    'duration' => $this->input->post('duration'),
                    'date_submitted' => date("Y-m-d"),
                    
                    
                );
        
            $insert = $this->leave->save($data);

            echo json_encode(array("status" => TRUE, "start" => $start, "end" => $end));

               }else{

                echo json_encode(array("status" => true, "start" => $start, "end" => $end));

            }
        }else{
            $this->_validate();

            $info = "You have remaining leave to fulfill";

            echo json_encode(array("status" => true, "warning" => $info));


        }
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
                'user_id' => $this->session->userdata('username'),
                'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'leavetype' => $this->input->post('leavetype'),
                'leave_status' => 'requested',
                'cause' => $this->input->post('cause'),
                'duration' => $this->input->post('duration'),
            );
        $this->leave->update(array('leave_id' => $this->input->post('id')), $data);
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
        $data['start'] = array();
        $data['end'] = array();
         $data['warning'] = array();
 
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

// approval
//
//

     public function approval_list()
    {
        $list = $this->leave->approval_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $leave) {
              $class = 'label label-success';
        if ($leave->leave_status === 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
             $row[] = ucfirst($leave->firstname).' '.ucfirst(substr($leave->middlename,0,1)).'. '.ucfirst($leave->lastname);
            $row[] = $leave->position;
            $row[] = $leave->department;
            $row[] = $leave->leavetype;
            $row[] = date("F j,Y", strtotime($leave->startdate));
            $row[] = date("F j,Y", strtotime($leave->enddate));
             $row[] = $leave->duration;
             $row[] = $leave->cause;
             $row[] = '<h4><span class="'.$class.'">'.$leave->leave_status.'</span></h4>'; 
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="accept_leave('."'".$leave->user_id."'".')">Accept</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="decline_leave('."'".$leave->leave_id."'".')">Decline</a>';

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

     public function accept_leave($id)
    {

        $date = $this->leave->get_leave_date($id);

       $startdate = $date->startdate;
       $enddate = $date->enddate;

       while ($startdate <= $enddate) {

                $list = $this->leave->get_sched($id);

            foreach ($list as $value) {
                $date_id = $value->sched_id;
                $datetime = date_create($value->start);
                $date = date_format($datetime,"Y-m-d");

                if($startdate == $date){

                    if($value->work_status == 'active'){
                       
                        $data = array(
                
                            'work_status' => 'leave',
                            'color' => '#f7bc38',
                                
                        );
                      
                    $this->leave->sched_update($data, $id, $date_id);

                    }
                }
            }

        $startdate = date ("Y-m-d", strtotime("+1 days", strtotime($startdate)));

        }
         $date1 = $this->leave->get_leave_date($id);
       $startdate1 = $date1->startdate;
       $enddate1 = $date1->enddate;

       $check = "";

        while ($startdate1 <= $enddate1) {

                $list = $this->leave->get_emp_attendance($id);

            foreach ($list as $value) {
                $date_id = $value->date;
                $datetime = date_create($value->date);
                $date = date_format($datetime,"Y-m-d");
            

                if($startdate1 == $date){

                    if($value->attnd_status == 'active'){
                       
                        $data = array(
                
                            'attnd_status' => 'leave',
                                
                        );
                      
                    $this->leave->attendance_update($data, $id, $date_id);

                    $check = "$id.''.$date_id";
                    }
                }
            }

        $startdate1 = date ("Y-m-d", strtotime("+1 days", strtotime($startdate1)));

        }
 
        $data = array(
                
                'leave_status' => 'approved',
                'date_approved' => date("Y-m-d"),
                
            );
        $this->leave->update(array('user_id' => $id), $data);
        echo json_encode(array("status" => TRUE, "check" => $check));
    }



    public function approval_history_list()
    {
        $list = $this->leave->leave_approval_history_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $leave) {
              $class = 'label label-success';
        if ($leave->leave_status === 'requested') {
            $class = 'label label-info';
        }
            $no++;
            $row = array();
            $row[] = ucfirst($leave->firstname).' '.ucfirst(substr($leave->middlename,0,1)).'. '.ucfirst($leave->lastname);
            $row[] = $leave->position;
            $row[] = $leave->department;
            $row[] = $leave->leavetype;
            $row[] = date("F j,Y", strtotime($leave->startdate));
            $row[] = date("F j,Y", strtotime($leave->enddate));
             $row[] = $leave->duration;
             $row[] = $leave->cause;
             $row[] = date("F j,Y", strtotime($leave->date_submitted));
            $row[] = date("F j,Y", strtotime($leave->date_approved));
             $row[] = '<h4><span class="'.$class.'">'.$leave->leave_status.'</span></h4>'; 
           
          

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



    
}
?>