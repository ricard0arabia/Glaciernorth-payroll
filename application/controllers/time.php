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
        else if ($time->sched_type === 'regular' || $time->sched_type === 'special') {
            $class1 = 'label label-warning';
            $sched_type = "Holiday";
        }
//  
         $class2 = '';
         if ($time->work_status === 'absent') {
            $class2 = 'label label-danger';
        }
        else if ($time->work_status === 'leave') {
            $class2 = 'label label-warning';
        }
        else if ($time->work_status === 'overtime') {
            $class2 = 'label label-primary';
        } 
            $no++;
            $row = array();
         	
         	$row[] = '<img height="60" width="60" src="'.base_url().'uploads/'.$time->thumb_name.$time->ext.'">';
            $row[] = ucfirst($time->firstname).' '.ucfirst(substr($time->middlename,0,1)).'. '.ucfirst($time->lastname);
            $row[] = $time->position;
            $row[] = $time->department;
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

         $data = array(
                
                'time_in' => $this->input->post('time_in'),
                'time_out' => $this->input->post('time_out'),
                'hours_worked' => $this->input->post('totalhours'),
                'overtime' => $this->input->post('overtime'),
                'undertime' => $this->input->post('undertime'),
                'tardiness' => $this->input->post('tardiness'),
                'attnd_status' => $this->input->post('status'),
               
                
            );
         $user_id = $this->input->post('id');
        $this->time->attendance_update($data,$user_id,$date);
        $color = '#264281';
        if($this->input->post('status') == 'absent'){
            $color = '#ea4335';
        }

        $data1 = array(
                
                'work_status' => $this->input->post('status'),
                'color' => $color,
               
                
            );
         $this->time->sched_update1($data1,$user_id,$date);
        echo json_encode(array("status" => TRUE));

       
    }
    public function get_attendance($id,$date){
        $date = str_replace('_', '-', $date);
        $data = $this->time->get_emp_sched($id,$date);

        $sched = array(
                 "work_status" => $data->work_status,         
                "start" => $data->start,
                "end" => $data->end,
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
          if($this->input->post('undertime') == '')
        {
            $data['inputerror'][] = 'undertime';
            $data['error_string'][] = 'Undertime is required';
            $data['status'] = FALSE;
        }
         if($this->input->post('tardiness') == '')
        {
            $data['inputerror'][] = 'tardiness';
            $data['error_string'][] = 'Tardiness is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('totalhours') == '')
        {
            $data['inputerror'][] = 'totalhours';
            $data['error_string'][] = 'Total hours is required';
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
            $no++;
            $row = array();
            
      
            $row[] = date("F j,Y", strtotime($time->date));
            $row[] = $time->time_in;
            $row[] = $time->time_out;
            $row[] = $time->hours_worked;
            $row[] = $time->overtime;
            $row[] = $time->tardiness;
            $row[] = $time->undertime;
            $row[] = $time->attnd_status;
       
           

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