<?php


class Time extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('Contents','time');
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
        $this->load->view('pages/timesheet',$data);
        $this->load->view('footer');
        }
    
    }   

    public function attendance($id){

        $this->load->view('header');
        $data['user'] = $this->session->userdata('username');
        $data['timesheet_data'] = $this->time->emp_get_time($id);
        $this->load->view('pages/attendance',$data);
        $this->load->view('footer');

    }

     public function timesheet_list()
    {
        $list = $this->time->time_get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $time) {
            $no++;
            $row = array();
         

            $row[] = $time->timesheet_id;
            $row[] = date("F j,Y", strtotime($time->date));
       
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('time/attendance/'.$time->timesheet_id).'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_employee('."'".$time->timesheet_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->time->time_count_all(),
                        "recordsFiltered" => $this->time->time_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function add_timesheet()
    {
       
        $this->_validate();

        $list = $this->time->get_time();
       $startdate = $this->input->post('startdate');
       $enddate = $this->input->post('enddate');
       $temp = true;
       foreach($list as $check){

            if($check->date == $startdate){

                $temp = false;
                break;
            }
       }


       if($temp){
        $data = array();
                
                while($startdate <= $enddate){


                      $data = array(
                    
                    'date' => $startdate,
                    

                    )
                      ;
                $insert = $this->time->time_save($data);
                $startdate = date ("Y-m-d", strtotime("+1 days", strtotime($startdate)));
              

                }
                 echo json_encode(array("status" => TRUE));
            }
            else{
        echo json_encode(array("status" => TRUE, "warning" => false));
     }
    }

     public function attendance_list($date)
    {

        $list = $this->time->attendance_get_datatables($this->session->userdata('username'), $date);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $time) {
//
              $class1 = '';
              $sched_type = $time->sched_type;
        if ($time->sched_type === 'day off') {
            $class1 = 'label label-default';
        }
        else if ($time->sched_type === 'day shift') {
            $class1 = 'label label-success';
        }
        else if ($time->sched_type === 'night shift') {
            $class1 = 'label label-primary';
        } 
      
//  
         $class2 = '';
         if ($time->work_status === 'leave') {
            $class2 = 'label label-warning';
        }
        else if ($time->work_status === 'overtime') {
            $class2 = 'label label-primary';
        }
//
        $class3 = '';
         if ($time->attendance_status === 'absent') {
            $class3 = 'label label-danger';
        }
        else if ($time->attendance_status === 'present') {
            $class3 = 'label label-success';
        }
         else if ($time->attendance_status === 'inactive') {
            $class3 = 'label label-info';
        }
      
            $no++;
            $row = array();
            
            $row[] = '<img height="60" width="60" src="'.base_url().'uploads/'.$time->thumb_name.$time->ext.'">';
            $row[] = ucfirst($time->firstname).' '.ucfirst(substr($time->middlename,0,1)).'. '.ucfirst($time->lastname);
            $row[] = $time->position;
            $row[] = $time->time_in;
            $row[] = $time->time_out;
            $row[] = $time->hours_worked;
            $row[] = $time->overtime;
            $row[] = $time->night_diff_ot;
            $row[] = $time->tardiness;
            $row[] = $time->undertime;

            $row[] = '<h4><span class="'.$class1.'">'.$sched_type.'</span></h4>'; 
             $row[] = '<h4><span class="'.$class2.'">'.$time->work_status.'</span></h4>'; 
              $row[] = '<strong>'.$time->overtime_type.'</strong>'; 
               $row[] = '<h4><span class="label label-warning">'.$time->holiday_type.'</span></h4>'; 
                $row[] = '<h4><span class="'.$class3.'">'.$time->attendance_status.'</span></h4>'; 
       
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="add_attendance('."'".$time->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_leave('."'".$time->user_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->time->attendance_count_all(),
                        "recordsFiltered" => $this->time->attendance_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

      public function add_attendance($date)
    {
       
        $this->_validate1();

        $user_id = $this->input->post('id');

        $sched_start = date("Y-m-d",strtotime($this->input->post('start')));
        $sched_end = date("Y-m-d",strtotime($this->input->post('end')));
        $time_in =  date("Y-m-d",strtotime($this->input->post('time_in')));
        $time_out =  date("Y-m-d",strtotime($this->input->post('time_out')));

        $check = $this->time->check_emp_attendance($user_id,$date);

        $attendance_status = $check->attendance_status;

        $check_date_validity = false;

        if($attendance_status != "inactive"){
//
            if($check->sched_type == "day off"){

                $sched_end1 =  date("Y-m-d", strtotime("+1 days", strtotime($this->input->post('end'))));

                if(($sched_start == $time_in && $sched_end == $time_out) || ($sched_start == $time_in && $sched_end1 == $time_out)){

                    $check_date_validity = true;

                }else{

                    echo json_encode(array("status" => TRUE, "warning" => false,"check" => 'Entered dates must be the same with the schedule'));

                }

//
            }else{

                    if($sched_start == $time_in && $sched_end == $time_out){

                        $check_date_validity = true;
                 
                    }else{

                    echo json_encode(array("status" => TRUE, "warning" => false,"check" => 'Entered dates must be the same with the schedule'));


                    }
                }


            if($check_date_validity){


                $time_in = date("Y-m-d H:i", strtotime($this->input->post('time_in'))).":00";
                $time_out = date("Y-m-d H:i", strtotime($this->input->post('time_out'))).":00";

                $night_diff_start = date('Y-m-d 22:00:00',strtotime($sched_start));
                $night_diff_end = date('Y-m-d 06:00:00',strtotime("+1 days", strtotime($sched_start)));

                $given = $this->input->post('overtime');
                $hour = floor($given);
                $minutes = ($given-$hour)*60;

                $ot_start = date('Y-m-d H:i:s',strtotime('-'.$hour.' hour -'.$minutes.'minutes',strtotime($time_out)));


                $non_night_diff_hours = 0;
                $night_diff_hours = 0;

                for($i = 0; $i < $given; $i+=.25){

                    $temp = $i*60;
                    $time =  date('Y-m-d H:i:s',strtotime('+'.$temp.'minutes',strtotime($ot_start)));

                    if($night_diff_start <= $time && $time <= $night_diff_end){

                        $night_diff_hours += .25;

                    }else{

                        $non_night_diff_hours += .25;

                    }

                }

                $total_ot_hours = $non_night_diff_hours + $night_diff_hours;

                $data = array(
                            
                            'time_in' => $time_in,
                            'time_out' => $time_out,
                            'hours_worked' => $this->input->post('totalhours'),
                            'overtime' => $total_ot_hours,
                            'tardiness' => $this->input->post('tardiness'),
                            'undertime' => $this->input->post('undertime'),
                            'attendance_status'=> $this->input->post('status'),
                            'night_diff_ot'=> $night_diff_hours,
                           
                            
                        );
                     
                    $this->time->attendance_update($data,$user_id,$date);


                    $color = '#264281';
                        if($this->input->post('status') == 'absent'){
                            $color = '#ea4335';
                        }

                    $data1 = array(
                            
                            'attendance_status' => $this->input->post('status'),
                            'color' => $color,
                           
                            
                        );
                     $this->time->sched_update1($data1,$user_id,$date);
                    echo json_encode(array("status" => TRUE, "warning" => true, "check" => $time_in));

            }

        }else{


             echo json_encode(array("status" => TRUE, "warning" => false,"check" => 'Inactive attendance status is uneditable'));


        }
       
    }
     public function get_attendance($id,$date){
        $date = str_replace('_', '-', $date);
        $sched_data = $this->time->get_emp_sched($id,$date);
        $ot_data = $this->time->get_overtime_duration($id,$date);
        if($ot_data == false){

            $ot_duration = 0;
        }else{

           $ot_duration = $ot_data->duration;
        }
        $sched = array(

                 "attendance_status" => $sched_data->attendance_status,         
                "start" => $sched_data->start,
                "end" => $sched_data->end,
                "overtime" => $ot_duration,
        );

        echo json_encode($sched);

    }

    public function hello()
    {
          $result = $this->time->attendance_get_datatables($this->session->userdata('username'));
        echo json_encode($result);

    }


           private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
         $data['warning'] = array();
 

          if($this->input->post('startdate') == '')
        {
            $data['inputerror'][] = 'startdate';
            $data['error_string'][] = 'Start date no. is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('enddate') == '')
        {
            $data['inputerror'][] = 'enddate';
            $data['error_string'][] = 'End date is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    } 
       private function _validate1()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
         $data['check'] = array();
         $data['warning'] = array();
 
             if($this->input->post('time_in') == '')
        {
            $data['inputerror'][] = 'time_in';
            $data['error_string'][] = 'Time-in is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('time_out') == '')
        {
            $data['inputerror'][] = 'time_out';
            $data['error_string'][] = 'Time-out is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('overtime') == '')
        {
            $data['inputerror'][] = 'overtime';
            $data['error_string'][] = 'Overitme is required';
            $data['status'] = FALSE;
        }
       
         if($this->input->post('tardiness') == '')
        {
            $data['inputerror'][] = 'tardiness';
            $data['error_string'][] = 'Tardiness is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('undertime') == '')
        {
            $data['inputerror'][] = 'undertime';
            $data['error_string'][] = 'Undertime is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('totalhours') == '')
        {
            $data['inputerror'][] = 'totalhours';
            $data['error_string'][] = 'Total hours is required';
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

      public function emp_attendance_list()
    {

        $list = $this->time->emp_attendance_get_datatables($this->session->userdata('username'));

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $time) {
       //
              $class1 = '';
              $sched_type = $time->sched_type;
        if ($time->sched_type === 'day off') {
            $class1 = 'label label-default';
        }
        else if ($time->sched_type === 'day shift') {
            $class1 = 'label label-success';
        }
        else if ($time->sched_type === 'night shift') {
            $class1 = 'label label-primary';
        } 
//  
         $class2 = '';
        if ($time->work_status === 'leave') {
            $class2 = 'label label-warning';
        }
        else if ($time->work_status === 'overtime') {
            $class2 = 'label label-primary';
        } 

         $class3 = '';
         if ($time->attendance_status === 'absent') {
            $class3 = 'label label-danger';
        }
        else if ($time->attendance_status === 'present') {
            $class3 = 'label label-success';
        }
         else if ($time->attendance_status === 'inactive') {
            $class3 = 'label label-info';
        }
            $no++;
            $row = array();
            

            $row[] = date("F j,Y", strtotime($time->date));
            $row[] = $time->time_in;
            $row[] = $time->time_out;
            $row[] = $time->hours_worked;
            $row[] = $time->overtime;
            $row[] = $time->tardiness;
            $row[] = $time->undertime;

            $row[] = '<h4><span class="'.$class1.'">'.$sched_type.'</span></h4>'; 
             $row[] = '<h4><span class="'.$class2.'">'.$time->work_status.'</span></h4>'; 
              $row[] = $time->overtime_type; 
              $row[] = '<h4><span class="label label-warning">'.$time->holiday_type.'</span></h4>'; 
        $row[] = '<h4><span class="'.$class3.'">'.$time->attendance_status.'</span></h4>'; 
           

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->time->attendance_count_all(),
                        "recordsFiltered" => $this->time->attendance_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    
}
?>