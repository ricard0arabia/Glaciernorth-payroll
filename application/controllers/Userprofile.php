<?php
class Userprofile extends CI_Controller {
    var $pgToLoad;
    
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Contents','profile');
        $this->load->library('form_validation');
    }


    public function index() {       
         if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('login/login_form');
        }
        else{
       
            $this->load->helper('url'); 
            $this->load->view('header');
            $data['level'] = $this->session->userdata('level');
            $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
      
            $this->load->view('pages/profile', $data);
            $this->load->view('footer');
       }
    }   




  public function employee_details()
  {
        $data = $this->profile->emp_get_by_id($this->session->userdata('username'));
        echo json_encode($data);
  }

   public function update_basicinfo()
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
        $this->profile->emp_update(array('user_id' => $this->session->userdata('username')), $data);
        echo json_encode(array("status" => TRUE));
    }

     public function update_otherdetails()
    {
 
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
        $this->profile->emp_update(array('user_id' => $this->session->userdata('username')), $data);
        echo json_encode(array("status" => TRUE));
    }




     public function empsched_list()
    {
        $list = $this->profile->empsched_get_datatables($this->session->userdata('username'));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $profile) {
            $no++;
            $row = array();
             


$row[] = date("h:i A", strtotime($profile->mon_start)).' - '.date("h:i A", strtotime($profile->mon_end));
$row[] = date("h:i A", strtotime($profile->tue_start)).' - '.date("h:i A", strtotime($profile->tue_end));
$row[] = date("h:i A", strtotime($profile->wed_start)).' - '.date("h:i A", strtotime($profile->wed_end));
$row[] = date("h:i A", strtotime($profile->thurs_start)).' - '.date("h:i A", strtotime($profile->thurs_end));
$row[] = date("h:i A", strtotime($profile->fri_start)).' - '.date("h:i A", strtotime($profile->fri_end));
$row[] = date("h:i A", strtotime($profile->sat_start)).' - '.date("h:i A", strtotime($profile->sat_end));
$row[] = date("h:i A", strtotime($profile->sun_start)).' - '.date("h:i A", strtotime($profile->sun_end));


                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->profile->emp_count_all(),
                        "recordsFiltered" => $this->profile->emp_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



        function do_upload(){
            if($this->input->post('upload')){

                $config['upload_path'] ='./uploads/';
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
                    $this->profile->add_image($file,$this->session->userdata('username'));
                    $data = array('upload_data' => $this->upload->data());

                    $this->load->helper('url');    
            $this->load->view('header');
            $data['level'] = $this->session->userdata('level');
            $data['notif'] = $this->uploadinfo();
            $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
            $data['exist'] = $this->profile->empinfo_count_all($this->session->userdata('username'));
            $this->load->view('pages/profile', $data);
            $this->load->view('footer');
                
                    
                }else{
    
                    $error = array('error' => $this->upload->display_errors());
                    $data['notif'] = $this->uploadinfo();
                     $this->load->view('header');
            $data['image'] = $this->profile->get_image_profile($this->session->userdata('username'));
            
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



while (strtotime($start_date) <= strtotime($end_date)) {

    $timestamp = strtotime($start_date);
    $day = date('D', $timestamp);

    if($day == 'Mon'){
    $temp_startdate =  "$start_date"." $mon_start";
    $temp_day = $day;

    if($mon_end == '06:00:00'){

    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $mon_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }

    else{
         $temp_enddate = "$start_date"." $mon_end ";
        }
    }

    else if($day == 'Tue'){
    $temp_startdate =  "$start_date"." $tue_start";
    $temp_day = $day;

    if($tue_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $tue_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
        else{
           $temp_enddate =  "$start_date"." $tue_end ";
            }
    }

    else if($day == 'Wed'){
    $temp_startdate = "$start_date"." $wed_start";
    $temp_day = $day;

     if($wed_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $wed_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
    else{
            $temp_enddate =  "$start_date"." $wed_end ";
            }
    }

    else if($day == 'Thu'){
    $temp_startdate = "$start_date"." $thurs_start";
    $temp_day = $day;

     if($thurs_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $thurs_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
    else{
            $temp_enddate =  "$start_date"." $thurs_end ";
            }
    }

    else if($day == 'Fri'){
    $temp_startdate = "$start_date"." $fri_start";
    $temp_day = $day;

    if($fri_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $fri_end ";
     $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
        
    else{
            $temp_enddate =  "$start_date"." $fri_end ";
            }
    }

    else if($day == 'Sat'){
     $temp_startdate = "$start_date"." $sat_start";
    $temp_day = $day;

     if($sat_end == '06:00:00'){
     $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sat_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
        else{
          $temp_enddate =  "$start_date"." $sat_end ";
            }
    }


    else if($day == 'Sun'){
    $temp_startdate = "$start_date"." $sun_start";
    $temp_day = $day;

     if($sun_end == '06:00:00'){
    $temp_enddate = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)))." $sun_end ";
    $temp_day = date('D', strtotime(date("Y-m-d",strtotime("+1 days", strtotime($start_date)))));
    }
    else{
            $temp_enddate =  "$start_date"." $sun_end ";
            }
    }

    $data = array(

        'user_id' => $id,
        'start' => $temp_startdate,
        'end' => $temp_enddate,
        'day' => $temp_day,
        'status' => 'regular',
        'color' => '#264281',


        );
    $insert = $this->profile->sched_save($data);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
  }

        echo json_encode(array("status" => TRUE));
    }


private function _validate1()
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