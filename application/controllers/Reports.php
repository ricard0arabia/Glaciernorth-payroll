<?php


	class Reports extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Contents','reports');
		}


    public function tables(){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

          $this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/tables',$data);
          $this->load->view('footer');

           }

  }


    public function reports($id){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

          $this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $data['period'] = $this->reports->get_specific_reports_period($id);
          $this->load->view('pages/reports',$data);
          $this->load->view('footer');

           }

  }

  public function test_tax(){
    echo "<table border = 1>";
    echo "<tr>
            <th>date</th>
             <th>time_in </th>
              <th>time_out </th>
            <th>hours_worked </th>
            <th>overtime </th>
            <th>tardiness </th>
            <th>undertime </th>
            <th>sched_type </th>
            <th>work_status </th>
            <th>overtime_type </th>        
            <th>holiday_type </th>
            <th>attendance_status </th>
            <th>night_diff_ot </th>

            </tr>";
       

    $get =  $this->reports->test();

     foreach ($get as $asd) {

     echo "<tr>
          <td>".$asd->date."</td>".
          "<td>".$asd->time_in."</td>".
          "<td>".$asd->time_out."</td>".
          "<td>".$asd->hours_worked."</td>".
          "<td>".$asd->overtime."</td>".
          "<td>".$asd->tardiness."</td>".
          "<td>".$asd->undertime."</td>".
          "<td>".$asd->sched_type."</td>".
          "<td>".$asd->work_status."</td>".
          "<td>".$asd->overtime_type."</td>".
          "<td>".$asd->holiday_type."</td>".
          "<td>".$asd->attendance_status."</td>".
          "<td>".$asd->night_diff_ot."</td>

          </tr>";
      
    }
       echo "</table>";


  $basic_salary = $this->reports->get_salary();
  $basic_salary = $basic_salary->salary;
  $semi_monthly_salary = round($basic_salary/2,2);
  $daily_rate =  round(($basic_salary * 12)/261,2);
  $hourly_rate = round($daily_rate/8,2);

  echo "<strong>basic salary</strong> ".$basic_salary." ";
  echo "<strong>semi monthly salary</strong> ".$semi_monthly_salary." ";
  echo "<strong>daily rate</strong>  ".$daily_rate." ";
  echo "<strong>hourly rate</strong> ".$hourly_rate."<br>";

  $total_hours_worked = 0;
  $overtime_pay = 0;
  $ot_ordinary = 0;
  $ot_restday = 0;
  $ot_special_holiday = 0;
  $ot_regular_holiday = 0;
  $ot_nightdiff = 0;

    $list =  $this->reports->test();

    foreach ($list as  $value) {

      if($value->attendance_status == 'present'){

          if($value->work_status == 'overtime'){

              if($value->overtime_type == 'ordinary'){

                $ot_ordinary += ($value->overtime*$hourly_rate)*1.25;
                $overtime_pay += ($value->overtime*$hourly_rate)*1.25;       

              }else if($value->overtime_type == 'rest day'){

                $rest_day_hourly_rate = $hourly_rate*1.3;
                $ot_restday += ($value->overtime*$rest_day_rate)*1.30;
                $overtime_pay += ($value->overtime*$rest_day_rate)*1.30;
                    
              }else if($value->overtime_type == 'regular holiday'){

                $regular_holiday_hourly_rate = $hourly_rate*2;
                $ot_regular_holiday += ($value->overtime*$regular_holiday_hourly_rate)*1.30;
                $overtime_pay += ($value->overtime*$regular_holiday_hourly_rate)*1.30;

              }else if($value->overtime_type == 'special holiday'){

                $special_holiday_hourly_rate = $hourly_rate*1.3;
                $ot_special_holiday += ($value->overtime*$special_holiday_hourly_rate)*1.3;
                $overtime_pay += ($value->overtime*$special_holiday_hourly_rate)*1.3;
                    
              }else if($value->overtime_type == 'double holiday'){

                $double_holiday_hourly_rate = $hourly_rate*3;

                $overtime_pay += ($value->overtime*$double_holiday_hourly_rate)*3;   

              }else if($value->overtime_type == 'rest day/regular holiday'){

                $rest_regular_holiday_hourly_rate = $hourly_rate*2.6;

                $overtime_pay += ($value->overtime*$rest_regular_holiday_hourly_rate)*1.30;

              }else if($value->overtime_type == 'rest day/special holiday'){

                $rest_special_holiday_hourly_rate = $hourly_rate*1.5;

                $overtime_pay += ($value->overtime*$rest_special_holiday_hourly_rate)*1.30;

              }else if($value->overtime_type == 'rest day/double holiday'){

                $rest_double_holiday_hourly_rate = $hourly_rate*3;

                $overtime_pay += ($value->overtime*$double_holiday_hourly_rate)*3;                   

              }

          }


      }else if($value->attendance_status == 'absent'){




      
      }
    }


     echo "<strong>Ordinary overtime</strong> ".$ot_ordinary."<br><br>";
     echo "<strong>Rest day overtime</strong> ".$ot_restday."<br><br>";
     echo "<strong>Special holiday overtime</strong> ".$ot_special_holiday."<br><br>";
     echo "<strong>regular holiday overtime</strong> ".$ot_regular_holiday."<br><br>";
     echo "<strong>night differential overtime</strong> ".$ot_nightdiff."<br><br>";
     echo "<strong>Total overtime pay</strong> ".$overtime_pay."<br><br>";

  
  

  }

  public function reports_period(){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

          $this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/reports_period',$data);
          $this->load->view('footer');

           }

  }
   public function reports_period_list()
    {




        $list = $this->reports->reports_period_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();
        $row[] = $reports->period;
           $row[] = date("F j,Y", strtotime($reports->date_from));
            $row[] = date("F j,Y", strtotime($reports->date_to));
           $row[] = $reports->total_employee_share;
            $row[] = $reports->total_employer_share;
             $row[] = $reports->total_share;
      
                  //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('reports/reports/'.$reports->reports_period_id).'"><i class="glyphicon glyphicon-search"></i> View</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_reports_period('."'".$reports->reports_period_id."'".','."'".$reports->date_to."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->reports_period_count_all(),
                        "recordsFiltered" => $this->reports->reports_period_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function add_reports_period(){

         $this->_validate();


        $first1 = date('Y-m-01');
         $last1 = date('Y-m-t');

         $first2 = date('Y-m-d',strtotime('first day of next month'));
         $last2= date('Y-m-d',strtotime('last day of next month'));

         $first3 = date('Y-m-d',strtotime('first day of +2 month'));
         $last3 = date('Y-m-d',strtotime('last day of +2 month'));

         $first4 = date('Y-m-d',strtotime('first day of +3 month'));
         $last4 = date('Y-m-d',strtotime('last day of +3 month'));

         $first5 = date('Y-m-d',strtotime('first day of +4 month'));
         $last5 = date('Y-m-d',strtotime('last day of +4 month'));
         


    $startdate = $this->input->post('startdate');
    $enddate = $this->input->post('enddate');

          $checkstart = true;
          $info="";

         if($startdate == $first1){
            if($enddate == $last1){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
         }else if($startdate == $first2){
            if($enddate == $last2){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
         }else if($startdate == $first3){
            if($enddate == $last3){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
         }else if($startdate == $first4){
            if($enddate == $last4){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
         }else if($startdate == $first5){
            if($enddate == $last5){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
         }else{

          $checkstart = false;
          $info = "Start date must be the 1st day of the month";
         }


            $list = $this->reports->get_reports_period();

              foreach($list as $check){

              if($check->date_from == $startdate){

                $checkstart = false;
                $info = "Start date must not be the same with the previous";
                break;
              }

              if($check->date_to == $enddate){

                $checkstart = false;
                  $info = "End  date must not be the same with the previous";
                break;
              }
           }

           $emplist = $this->reports->check_emp_id();

          if($emplist->num_rows() == 0){
            $checkstart = false;
          }
         
//
           if($checkstart  == true){


            $emplist = $this->reports->get_emp_id();

            foreach ($emplist as $value) {

               $salary = $value->salary;
               
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

              

            $data = array(
                    
                    'user_id' => $value->user_id,
                    'sss_code' => $sss_code,
                    'philhealth_code' => $philhealth_code,
                    'period' => $this->input->post('enddate'),       
                    'salary' => $salary, 
                      'pagibig_employee_share' => $pagibig_employee_share,
                    'pagibig_employer_share' => $pagibig_employer_share,
                    'pagibig_total_share' => $pagibig_total_share,
                    
                );
             $this->reports->emp_contributions_save($data);

            }


          
                    
                   
                        $data = array(
                  
                  'date_from' => $this->input->post('startdate'),
                  'date_to' => $this->input->post('enddate'),
                  'period' => $this->input->post('enddate'),
                  'total_employer_share' => 0,
                  'total_employee_share' => 0,
                  'total_share' => 0,

                  

                  );

              $insert = $this->reports->reports_period_save($data);

                     echo json_encode(array("status" => TRUE));
                }
                else{

            echo json_encode(array("status" => TRUE, "warning" => true, "info" => $info));

          }

    }

    public function delete_reports_period($id,$date)
    {
        $this->reports->reports_period_delete_by_id($id);
         $this->reports->emp_contributions_delete_by_id($date);
        echo json_encode(array("status" => TRUE));
    }


   public function bir_table()
    {




        $list = $this->reports->bir_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();
        $row[] = $reports->taxstatus;
         $row[] = $reports->dependents;
          $row[] = $reports->minrange;
           $row[] = $reports->maxrange;
            $row[] = $reports->tax1;
             $row[] = $reports->tax2;
      
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->bir_count_all(),
                        "recordsFiltered" => $this->reports->bir_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }




  //philhealth
 public function philhealth_reports($period)
    {




        $list = $this->reports->philhealth_report_datatables($period);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();

             $row[] = $reports->user_id;
       $row[] = ucfirst($reports->lastname).', '.ucfirst($reports->firstname).' '.ucfirst(substr($reports->middlename,0,1)).'. ';
       $row[] = date("F j,Y", strtotime($reports->period));
         $row[] = $reports->philhealth_no;
          $row[] = $reports->philhealth_employee;
           $row[] = $reports->philhealth_employer;
           $row[] = $reports->philhealth_total;
      
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->philhealth_count_all(),
                        "recordsFiltered" => $this->reports->philhealth_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }




   public function philhealth_table()
    {




        $list = $this->reports->philhealth_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();
        $row[] = $reports->philhealth_min_salary;
         $row[] = $reports->philhealth_max_salary;
          $row[] = $reports->philhealth_employee;
           $row[] = $reports->philhealth_employer;
     
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->philhealth_count_all(),
                        "recordsFiltered" => $this->reports->philhealth_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



//



    public function pagibig_reports($period)
    {




        $list = $this->reports->pagibig_get_datatables($period);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();

             $row[] = $reports->user_id;
       $row[] = ucfirst($reports->lastname).', '.ucfirst($reports->firstname).' '.ucfirst(substr($reports->middlename,0,1)).'. ';
       $row[] = date("F j,Y", strtotime($reports->period));
         $row[] = $reports->hdmf_no;
          $row[] = $reports->pagibig_employee_share;
           $row[] = $reports->pagibig_employer_share;
           $row[] = $reports->pagibig_total_share;
      
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->pagibig_count_all(),
                        "recordsFiltered" => $this->reports->pagibig_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


//sss


   public function sss_reports($period)
    {




        $list = $this->reports->sss_report_datatables($period);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();

             $row[] = $reports->user_id;
       $row[] = ucfirst($reports->lastname).', '.ucfirst($reports->firstname).' '.ucfirst(substr($reports->middlename,0,1)).'. ';
       $row[] = date("F j,Y", strtotime($reports->period));
         $row[] = $reports->sss_no;
          $row[] = $reports->sss_employee;
           $row[] = $reports->sss_employer;
           $row[] = $reports->sss_total;
      
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->sss_count_all(),
                        "recordsFiltered" => $this->reports->sss_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


   public function sss_table()
    {




        $list = $this->reports->sss_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();
         $row[] = $reports->sss_min_salary;
         $row[] = $reports->sss_max_salary;
          $row[] = $reports->sss_employee;
           $row[] = $reports->sss_employer;
           $row[] = $reports->sss_total;
      
           
         
                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->reports->sss_count_all(),
                        "recordsFiltered" => $this->reports->sss_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



        private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
         $data['warning'] = array();
          $data['info'] = array();
 

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
  }

?>
