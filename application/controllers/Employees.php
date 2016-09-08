<?php


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
                'date_created' => date('Y-m-d'),
                'status' => '1',
             
                 
                
            );
   
        $insert = $this->employee->emp_save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function profile($id){


            $this->load->view('header');
            $data['level'] = $this->session->userdata('level');
            $data['image'] = $this->employee->get_image_profile($id);
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



  public function employee_details($id)
  {
        $data = $this->employee->emp_get_by_id($id);
        echo json_encode($data);
  }

   public function update_basicinfo($id)
    {
 
       $data = array(
                
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'birthdate' => $this->input->post('birthdate'),
                'cstatus' => $this->input->post('cstatus'),
                'contact_no' => $this->input->post('contact_no'),
                'email' => $this->input->post('emailadd'),
                'zipcode' => $this->input->post('zipcode'),
                'emp_pass' => md5($this->input->post('password')),
                'address' => $this->input->post('address'),
               
                
            );
        $this->employee->emp_update(array('user_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

     public function update_otherdetails($id)
    {

         $salary = $this->input->post('salary');
                    $sss_code = '0';

                    if(1000 <= $salary && $salary <= 1249.99){
                        $sss_code = '1';
                    }else{
                        if(15750 <= $salary && $salary <= 1000000){
                            $sss_code = '31';
                        }else{
                            $ctr = 2;
                            for($i = 1250; $i <= 15750; $i+=500){
                                if($i <= $salary && $salary <= ($i+499.99)){
                                    $sss_code = $ctr;
                                    break;
                                }
                                $ctr++;
                            }
                        }
                    }

                    $philhealth_code = '0';
                    $ctr = 1;
                    if($salary < 9000){

                        $philhealth_code = '1';
                    }
                    else if($salary < 35000){
                            for($i = 8000; $i <= 35000; $i+=1000){
                                if($i <= $salary && $salary < ($i+1000)){
                                    $philhealth_code = $ctr;
                                    break;
                                }
                                $ctr++;
                            }
                     }else{

                            $philhealth_code ='28';
                      }



$pagibig_employee_share = 0;
$pagibig_employer_share = 0;                
$pagibig_total_share = 0;


                if($salary <= 1500){

                    $pagibig_employee_share = $salary*.01;
                    $pagibig_employer_share = $salary*.02;   
                    $pagibig_total_share =  $pagibig_employee_share + $pagibig_employer_share;

                }else if(1500 < $salary && $salary < 5000){

                    $pagibig_employee_share = $salary*.02;
                    $pagibig_employer_share = $salary*.02;   
                    $pagibig_total_share =  $pagibig_employee_share + $pagibig_employer_share;

                }else{

                    $pagibig_employee_share = 100;
                    $pagibig_employer_share = 100;   
                    $pagibig_total_share =  $pagibig_employee_share + $pagibig_employer_share;

                }


        $temp = false;
        $list = $this->employee->get_emp_contributions($id);
        foreach ($list as $value) {
           if($value->period == date('Y-m-t')){

            $temp = true;
            break;

           }
        }

        if($temp){
            $data = array(
                    
                    'user_id' => $id,
                    'period' => date('Y-m-t'),       
                    'salary' => $this->input->post('salary'), 
                    'sss_code' => $sss_code,
                    'philhealth_code' => $philhealth_code,
                    'pagibig_employee_share' => $pagibig_employee_share,
                    'pagibig_employer_share' => $pagibig_employer_share,
                    'pagibig_total_share' => $pagibig_total_share,
                    
                );
            $this->employee->emp_contributions_update($data,$id,date('Y-m-t'));
            
        }

       $data = array(
                
                'department' => $this->input->post('department'),
                'position' => $this->input->post('position'),
                'userlevel' => $this->input->post('userlevel'),
                'taxstatus' => $this->input->post('taxstatus'),
                'datehired' => $this->input->post('datehired'),
                'salary' => $this->input->post('salary'),
                'hdmf_no' => $this->input->post('hdmf_no'),
                'tin_no' => $this->input->post('tin_no'),           
                'sss_no' => $this->input->post('sss_no'),
                'philhealth_no' => $this->input->post('philhealth_no'),
 
               
                
            );
        $this->employee->emp_update(array('user_id' => $id), $data);
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

                   $this->load->view('header');
            $data['level'] = $this->session->userdata('level');
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
//
    //

public function add_sched($id){

$this->_validate1();
date_default_timezone_set('UTC');





$start_date = $this->input->post('startdate');
$end_date = $this->input->post('enddate');


    if($this->input->post('mon_sched') == 'a'){

        $mon_start = '06:00:00';
        $mon_end = '14:00:00';

    }
    else if ($this->input->post('mon_sched') == 'b'){
        $mon_start = '14:00:00';
        $mon_end = '22:00:00';
    }
    else if ($this->input->post('mon_sched') == 'c'){
        $mon_start = '22:00:00';
        $mon_end = '06:00:00';
    }
    else if ($this->input->post('mon_sched') == 'd'){
        $mon_start = '08:00:00';
        $mon_end = '17:00:00';
    }
     else if ($this->input->post('mon_sched') == 'e'){
        $mon_start = '00:00:00';
        $mon_end = '00:00:00';
    }

//
    if($this->input->post('tue_sched') == 'a'){

        $tue_start = '06:00:00';
        $tue_end = '14:00:00';

    }
    else if ($this->input->post('tue_sched') == 'b'){
        $tue_start = '14:00:00';
        $tue_end = '22:00:00';
    }
    else if ($this->input->post('tue_sched') == 'c'){
        $tue_start = '22:00:00';
        $tue_end = '06:00:00';
    }
    else if ($this->input->post('tue_sched') == 'd'){
        $tue_start = '08:00:00';
        $tue_end = '17:00:00';
    }
     else if ($this->input->post('tue_sched') == 'e'){
        $tue_start = '00:00:00';
        $tue_end = '00:00:00';
    }

    if($this->input->post('wed_sched') == 'a'){

        $wed_start = '06:00:00';
        $wed_end = '14:00:00';

    }
    else if ($this->input->post('wed_sched') == 'b'){
        $wed_start = '14:00:00';
        $wed_end = '22:00:00';
    }
    else if ($this->input->post('wed_sched') == 'c'){
        $wed_start = '22:00:00';
        $wed_end = '06:00:00';
    }
    else if ($this->input->post('wed_sched') == 'd'){
        $wed_start = '08:00:00';
        $wed_end = '17:00:00';
    }
     else if ($this->input->post('wed_sched') == 'e'){
        $wed_start = '00:00:00';
        $wed_end = '00:00:00';
    }

//
    if($this->input->post('thurs_sched') == 'a'){

        $thurs_start = '06:00:00';
        $thurs_end = '14:00:00';

    }
    else if ($this->input->post('thurs_sched') == 'b'){
        $thurs_start = '14:00:00';
        $thurs_end = '22:00:00';
    }
    else if ($this->input->post('thurs_sched') == 'c'){
        $thurs_start = '22:00:00';
        $thurs_end = '06:00:00';
    }
    else if ($this->input->post('thurs_sched') == 'd'){
        $thurs_start = '08:00:00';
        $thurs_end = '17:00:00';
    }
     else if ($this->input->post('thurs_sched') == 'e'){
        $thurs_start = '00:00:00';
        $thurs_end = '00:00:00';
    }

//

    if($this->input->post('fri_sched') == 'a'){

        $fri_start = '06:00:00';
        $fri_end = '14:00:00';

    }
    else if ($this->input->post('fri_sched') == 'b'){
        $fri_start = '14:00:00';
        $fri_end = '22:00:00';
    }
    else if ($this->input->post('fri_sched') == 'c'){
        $fri_start = '22:00:00';
        $fri_end = '06:00:00';
    }
    else if ($this->input->post('fri_sched') == 'd'){
        $fri_start = '08:00:00';
        $fri_end = '17:00:00';
    }
     else if ($this->input->post('fri_sched') == 'e'){
        $fri_start = '00:00:00';
        $fri_end = '00:00:00';
    }
//
    if($this->input->post('sat_sched') == 'a'){

        $sat_start = '06:00:00';
        $sat_end = '14:00:00';

    }
    else if ($this->input->post('sat_sched') == 'b'){
        $sat_start = '14:00:00';
        $sat_end = '22:00:00';
    }
    else if ($this->input->post('sat_sched') == 'c'){
        $sat_start = '22:00:00';
        $sat_end = '06:00:00';
    }
    else if ($this->input->post('sat_sched') == 'd'){
        $sat_start = '08:00:00';
        $sat_end = '17:00:00';
    }
     else if ($this->input->post('sat_sched') == 'e'){
        $sat_start = '00:00:00';
        $sat_end = '00:00:00';
    }
//

    if($this->input->post('sun_sched') == 'a'){

        $sun_start = '06:00:00';
        $sun_end = '14:00:00';

    }
    else if ($this->input->post('sun_sched') == 'b'){
        $sun_start = '14:00:00';
        $sun_end = '22:00:00';
    }
    else if ($this->input->post('sun_sched') == 'c'){
        $sun_start = '22:00:00';
        $sun_end = '06:00:00';
    }
    else if ($this->input->post('sun_sched') == 'd'){
        $sun_start = '08:00:00';
        $sun_end = '17:00:00';
    }
     else if ($this->input->post('sun_sched') == 'e'){
        $sun_start = '00:00:00';
        $sun_end = '00:00:00';
    }



while (strtotime($start_date) <= strtotime($end_date)) {
$attendance_status = '';
$sched_type = '';
$color = '';

    $timestamp = strtotime($start_date);
    $day = date('D', $timestamp);

    if($day == 'Mon'){
    $temp_startdate =  "$start_date"." $mon_start";
    $temp_day = $day;

     if($mon_start == '00:00:00'){
         $temp_enddate = "$start_date"." $mon_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
     
    }else{

            if($mon_end == '06:00:00'){

            $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $mon_end ";
            $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
            $sched_type = 'night shift';
            $color = '#050f25';
            }

            else{

                 $temp_enddate = "$start_date"." $mon_end ";
                  $sched_type = 'day shift';
                  $color = '#264281';


                }
         }
    }

    else if($day == 'Tue'){
    $temp_startdate =  "$start_date"." $tue_start";
    $temp_day = $day;

    if($tue_start == '00:00:00'){
         $temp_enddate = "$start_date"." $tue_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
             $color = '#34a853';
        }else{

    if($tue_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $tue_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = 'night shift';
    $color = '#050f25';
    }
        else{
           $temp_enddate =  "$start_date"." $tue_end ";
           $sched_type  = 'day shift';
            $color = '#264281';
            }
        }
    }

    else if($day == 'Wed'){
    $temp_startdate = "$start_date"." $wed_start";
    $temp_day = $day;

    if($wed_start == '00:00:00'){
         $temp_enddate = "$start_date"." $wed_end ";
           $sched_type = 'day off';
           $attendance_status = 'inactive';
           $color = '#34a853';
        }else{

     if($wed_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $wed_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = 'night shift';
    $color = '#050f25';
    }
    else{
            $temp_enddate =  "$start_date"." $wed_end ";
            $sched_type = 'day shift';
             $color = '#264281';
            }
        }
    }

    else if($day == 'Thu'){
    $temp_startdate = "$start_date"." $thurs_start";
    $temp_day = $day;

    if($thurs_start == '00:00:00'){
         $temp_enddate = "$start_date"." $thurs_end ";
           $sched_type = 'day off';
           $attendance_status = 'inactive';
           $color = '#34a853';
          
        }else{

     if($thurs_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $thurs_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = 'night shift';
    $color = '#050f25';
    }
    else{
            $temp_enddate =  "$start_date"." $thurs_end ";
            $sched_type = 'day shift';
            $color = '#264281';
            }
        }
    }

    else if($day == 'Fri'){
    $temp_startdate = "$start_date"." $fri_start";
    $temp_day = $day;

    if($fri_start == '00:00:00'){
         $temp_enddate = "$start_date"." $fri_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
            
        }else{

    if($fri_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $fri_end ";
     $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
     $sched_type = 'night shift';
     $color = '#050f25';
    }
        
    else{
            $temp_enddate =  "$start_date"." $fri_end ";
            $sched_type = 'day shift';
            $color = '#264281';
            }
        }
    }

    else if($day == 'Sat'){
     $temp_startdate = "$start_date"." $sat_start";
    $temp_day = $day;

    if($sat_start == '00:00:00'){
         $temp_enddate = "$start_date"." $sat_end ";
           $sched_type = 'day off';
           $attendance_status = 'inactive';
           $color = '#34a853';
           
        }else{

     if($sat_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sat_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = 'night shift';
    $color = '#050f25';
    }
        else{
          $temp_enddate =  "$start_date"." $sat_end ";
          $sched_type = 'day shift';
          $color = '#264281';
            }
        }
    }


    else if($day == 'Sun'){
    $temp_startdate = "$start_date"." $sun_start";
    $temp_day = $day;

    if($sun_start == '00:00:00'){
         $temp_enddate = "$start_date"." $sun_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
            
        }else{

     if($sun_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sun_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = 'night shift';
    $color = '#050f25';
   
    }
    else{
            $temp_enddate =  "$start_date"." $sun_end ";
            $sched_type = 'day shift';
            $color = '#264281';
        
            }
        }
    }


      $list1 = $this->employee->get_sched($id);
        
    $checkdate = "";
         foreach ($list1 as $value) {
        $datetime = date_create($value->start);
        $date = date_format($datetime,"Y-m-d");
            if($start_date == $date){

               $checkdate = $value->sched_id;
                break;
            }
       }

     $list2 = $this->employee->get_holiday();
        
    $holiday_type = "";
         foreach ($list2 as $value) {
    
            if($start_date == $value->date){
                $attendance_status = 'inactive';
               $holiday_type = $value->type;
               $color = '#c2185b';
                break;
            }
       }

    $data = array(
        'user_id' => $id,
        'start' => $temp_startdate,
        'end' => $temp_enddate,
        'day' => $temp_day,
        'sched_type' => $sched_type,
        'color' => $color,
        'work_status' => '',
        'overtime_type' => '',
        'attendance_status' => $attendance_status,
        'holiday_type' => $holiday_type,




        );
    $insert = $this->employee->sched_save($data);

    $data1 = array(

        'user_id' => $id,
        'date' => $start_date,
        'time_in' => "",
        'time_out' => "",
        'hours_worked' => 0,
        'overtime' => 0,
        'tardiness' => 0,
        'sched_type' => $sched_type,
        'work_status' => '',
        'overtime_type' => '',
        'attendance_status' => $attendance_status,
        'holiday_type' => $holiday_type,


        );
    $insert = $this->employee->attendance_save($data1);


    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
  }

        echo json_encode(array("status" => TRUE));
	}


//
//
//
//


public function edit_sched($id){

$this->_validate1();
date_default_timezone_set('UTC');


 $list = $this->employee->get_sched($id);
        $start = false;
        $end = false;

         foreach ($list as $value) {
        $datetime = date_create($value->start);
        $date = date_format($datetime,"Y-m-d");
            if($this->input->post('startdate') == $date){

                $start = true;
                break;
            }
       }

        foreach ($list as $value) {
        $datetime = date_create($value->start);
        $date = date_format($datetime,"Y-m-d");
            if($this->input->post('enddate') == $date){

                $end = true;
                break;
            }
       }

 
  if($start == true && $end == true){

$start_date = $this->input->post('startdate');
$end_date = $this->input->post('enddate');


   if($this->input->post('mon_sched') == 'a'){

        $mon_start = '06:00:00';
        $mon_end = '14:00:00';

    }
    else if ($this->input->post('mon_sched') == 'b'){
        $mon_start = '14:00:00';
        $mon_end = '22:00:00';
    }
    else if ($this->input->post('mon_sched') == 'c'){
        $mon_start = '22:00:00';
        $mon_end = '06:00:00';
    }
    else if ($this->input->post('mon_sched') == 'd'){
        $mon_start = '08:00:00';
        $mon_end = '17:00:00';
    }
     else if ($this->input->post('mon_sched') == 'e'){
        $mon_start = '00:00:00';
        $mon_end = '00:00:00';
    }

//
    if($this->input->post('tue_sched') == 'a'){

        $tue_start = '06:00:00';
        $tue_end = '14:00:00';

    }
    else if ($this->input->post('tue_sched') == 'b'){
        $tue_start = '14:00:00';
        $tue_end = '22:00:00';
    }
    else if ($this->input->post('tue_sched') == 'c'){
        $tue_start = '22:00:00';
        $tue_end = '06:00:00';
    }
    else if ($this->input->post('tue_sched') == 'd'){
        $tue_start = '08:00:00';
        $tue_end = '17:00:00';
    }
     else if ($this->input->post('tue_sched') == 'e'){
        $tue_start = '00:00:00';
        $tue_end = '00:00:00';
    }

    if($this->input->post('wed_sched') == 'a'){

        $wed_start = '06:00:00';
        $wed_end = '14:00:00';

    }
    else if ($this->input->post('wed_sched') == 'b'){
        $wed_start = '14:00:00';
        $wed_end = '22:00:00';
    }
    else if ($this->input->post('wed_sched') == 'c'){
        $wed_start = '22:00:00';
        $wed_end = '06:00:00';
    }
    else if ($this->input->post('wed_sched') == 'd'){
        $wed_start = '08:00:00';
        $wed_end = '17:00:00';
    }
     else if ($this->input->post('wed_sched') == 'e'){
        $wed_start = '00:00:00';
        $wed_end = '00:00:00';
    }

//
    if($this->input->post('thurs_sched') == 'a'){

        $thurs_start = '06:00:00';
        $thurs_end = '14:00:00';

    }
    else if ($this->input->post('thurs_sched') == 'b'){
        $thurs_start = '14:00:00';
        $thurs_end = '22:00:00';
    }
    else if ($this->input->post('thurs_sched') == 'c'){
        $thurs_start = '22:00:00';
        $thurs_end = '06:00:00';
    }
    else if ($this->input->post('thurs_sched') == 'd'){
        $thurs_start = '08:00:00';
        $thurs_end = '17:00:00';
    }
     else if ($this->input->post('thurs_sched') == 'e'){
        $thurs_start = '00:00:00';
        $thurs_end = '00:00:00';
    }

//

    if($this->input->post('fri_sched') == 'a'){

        $fri_start = '06:00:00';
        $fri_end = '14:00:00';

    }
    else if ($this->input->post('fri_sched') == 'b'){
        $fri_start = '14:00:00';
        $fri_end = '22:00:00';
    }
    else if ($this->input->post('fri_sched') == 'c'){
        $fri_start = '22:00:00';
        $fri_end = '06:00:00';
    }
    else if ($this->input->post('fri_sched') == 'd'){
        $fri_start = '08:00:00';
        $fri_end = '17:00:00';
    }
     else if ($this->input->post('fri_sched') == 'e'){
        $fri_start = '00:00:00';
        $fri_end = '00:00:00';
    }
//
    if($this->input->post('sat_sched') == 'a'){

        $sat_start = '06:00:00';
        $sat_end = '14:00:00';

    }
    else if ($this->input->post('sat_sched') == 'b'){
        $sat_start = '14:00:00';
        $sat_end = '22:00:00';
    }
    else if ($this->input->post('sat_sched') == 'c'){
        $sat_start = '22:00:00';
        $sat_end = '06:00:00';
    }
    else if ($this->input->post('sat_sched') == 'd'){
        $sat_start = '08:00:00';
        $sat_end = '17:00:00';
    }
     else if ($this->input->post('sat_sched') == 'e'){
        $sat_start = '00:00:00';
        $sat_end = '00:00:00';
    }
//

    if($this->input->post('sun_sched') == 'a'){

        $sun_start = '06:00:00';
        $sun_end = '14:00:00';

    }
    else if ($this->input->post('sun_sched') == 'b'){
        $sun_start = '14:00:00';
        $sun_end = '22:00:00';
    }
    else if ($this->input->post('sun_sched') == 'c'){
        $sun_start = '22:00:00';
        $sun_end = '06:00:00';
    }
    else if ($this->input->post('sun_sched') == 'd'){
        $sun_start = '08:00:00';
        $sun_end = '17:00:00';
    }
     else if ($this->input->post('sun_sched') == 'e'){
        $sun_start = '00:00:00';
        $sun_end = '00:00:00';
    }



while (strtotime($start_date) <= strtotime($end_date)) {
$attendance_status = '';
$sched_type = '';
$color = '';

    $timestamp = strtotime($start_date);
    $day = date('D', $timestamp);

    if($day == 'Mon'){
    $temp_startdate =  "$start_date"." $mon_start";
    $temp_day = $day;

     if($mon_start == '00:00:00'){
         $temp_enddate = "$start_date"." $mon_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
     
        }else{

    if($mon_end == '06:00:00'){

    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $mon_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
    }

    else{

         $temp_enddate = "$start_date"." $mon_end ";
          $sched_type = "day shift";
          $color = '#264281';


        }
    }
    }

    else if($day == 'Tue'){
    $temp_startdate =  "$start_date"." $tue_start";
    $temp_day = $day;

    if($tue_start == '00:00:00'){
         $temp_enddate = "$start_date"." $tue_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
             $color = '#34a853';
        }else{

    if($tue_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $tue_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
    }
        else{
           $temp_enddate =  "$start_date"." $tue_end ";
           $sched_type  = "day shift";
            $color = '#264281';
            }
        }
    }

    else if($day == 'Wed'){
    $temp_startdate = "$start_date"." $wed_start";
    $temp_day = $day;

    if($wed_start == '00:00:00'){
         $temp_enddate = "$start_date"." $wed_end ";
           $sched_type = "day off";
           $attendance_status = 'inactive';
           $color = '#34a853';
        }else{

     if($wed_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $wed_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
    }
    else{
            $temp_enddate =  "$start_date"." $wed_end ";
            $sched_type = "day shift";
             $color = '#264281';
            }
        }
    }

    else if($day == 'Thu'){
    $temp_startdate = "$start_date"." $thurs_start";
    $temp_day = $day;

    if($thurs_start == '00:00:00'){
         $temp_enddate = "$start_date"." $thurs_end ";
           $sched_type = 'day off';
           $attendance_status = 'inactive';
           $color = '#34a853';
          
        }else{

     if($thurs_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $thurs_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
    }
    else{
            $temp_enddate =  "$start_date"." $thurs_end ";
            $sched_type = "day shift";
            $color = '#264281';
            }
        }
    }

    else if($day == 'Fri'){
    $temp_startdate = "$start_date"." $fri_start";
    $temp_day = $day;

    if($fri_start == '00:00:00'){
         $temp_enddate = "$start_date"." $fri_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
            
        }else{

    if($fri_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $fri_end ";
     $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
     $sched_type = "night shift";
     $color = '#050f25';
    }
        
    else{
            $temp_enddate =  "$start_date"." $fri_end ";
            $sched_type = "day shift";
            $color = '#264281';
            }
        }
    }

    else if($day == 'Sat'){
     $temp_startdate = "$start_date"." $sat_start";
    $temp_day = $day;

    if($sat_start == '00:00:00'){
         $temp_enddate = "$start_date"." $sat_end ";
           $sched_type = 'day off';
           $attendance_status = 'inactive';
           $color = '#34a853';
           
        }else{

     if($sat_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sat_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
    }
        else{
          $temp_enddate =  "$start_date"." $sat_end ";
          $sched_type = "day shift";
          $color = '#264281';
            }
        }
    }


    else if($day == 'Sun'){
    $temp_startdate = "$start_date"." $sun_start";
    $temp_day = $day;

    if($sun_start == '00:00:00'){
         $temp_enddate = "$start_date"." $sun_end ";
            $sched_type = 'day off';
            $attendance_status = 'inactive';
            $color = '#34a853';
            
        }else{

     if($sun_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sun_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    $sched_type = "night shift";
    $color = '#050f25';
   
    }
    else{
            $temp_enddate =  "$start_date"." $sun_end ";
            $sched_type = "day shift";
            $color = '#264281';
        
            }
        }
    }


      $list1 = $this->employee->get_sched($id);
        
    $checkdate = "";
         foreach ($list1 as $value) {
        $datetime = date_create($value->start);
        $date = date_format($datetime,"Y-m-d");
            if($start_date == $date){

               $checkdate = $value->sched_id;
                break;
            }
       }

     $list2 = $this->employee->get_holiday();
        
   $holiday_type = "";
         foreach ($list2 as $value) {
    
            if($start_date == $value->date){
                $attendance_status = 'inactive';
               $holiday_type = $value->type;
               $color = '#c2185b';
                break;
            }
       }

    $data = array(
        'user_id' => $id,
        'start' => $temp_startdate,
        'end' => $temp_enddate,
        'day' => $temp_day,
        'sched_type' => $sched_type,
        'color' => $color,
        'work_status' => '',
        'overtime_type' => '',
        'attendance_status' => $attendance_status,
        'holiday_type' => $holiday_type,




        );
     $this->employee->sched_update($data, $id, $checkdate);

     $data1 = array(

        'user_id' => $id,
        'date' => $start_date,
        'time_in' => "",
        'time_out' => "",
        'hours_worked' => 0,
        'overtime' => 0,
        'tardiness' => 0,
        'sched_type' => $sched_type,
        'work_status' => '',
        'overtime_type' => '',
        'attendance_status' => $attendance_status,
        'holiday_type' => $holiday_type,

        );

      $this->employee->attendance_update($data1, $id, $start_date);


    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
  }

         echo json_encode(array("status" => true, "start" => $start, "end" => $end));
    }else{

          echo json_encode(array("status" => true, "start" => $start, "end" => $end));

    }
}




private function _validate1()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $data['start'] = array();
        $data['end'] = array();
 
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

          if($this->input->post('mon_sched') == '')
        {
            $data['inputerror'][] = 'mon_sched';
            $data['error_string'][] = 'Monday sched is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('tue_sched') == '')
        {
            $data['inputerror'][] = 'tue_sched';
            $data['error_string'][] = 'Tuesday sched is required';
            $data['status'] = FALSE;
        }
 

        if($this->input->post('wed_sched') == '')
        {
            $data['inputerror'][] = 'wed_sched';
            $data['error_string'][] = 'Wednesday sched is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('thurs_sched') == '')
        {
            $data['inputerror'][] = 'thurs_sched';
            $data['error_string'][] = 'Thursday sched is required';
            $data['status'] = FALSE;
        }

          if($this->input->post('fri_sched') == '')
        {
            $data['inputerror'][] = 'fri_sched';
            $data['error_string'][] = 'Friday sched is required';
            $data['status'] = FALSE;
        }
          if($this->input->post('sat_sched') == '')
        {
            $data['inputerror'][] = 'sat_sched';
            $data['error_string'][] = 'Saturday sched is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('sun_sched') == '')
        {
            $data['inputerror'][] = 'sun_sched';
            $data['error_string'][] = 'Sunday sched is required';
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