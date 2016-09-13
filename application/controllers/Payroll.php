<?php


	class Payroll extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Contents','payroll');
		}

		public function index(){

			if($this->session->userdata('isLogin') == FALSE)
		{

		redirect('login/login_form');

		}else{

			$this->load->model('Contents');
			$user = $this->session->userdata('username');
			$data['level'] = $this->session->userdata('level');
			$data['user'] = $this->Contents->userData($user);
			$this->load->view('header');
			$this->load->view('pages/payperiod', $data);
			$this->load->view('footer');
		}
	}

	public function payroll($id){

		$this->load->view('header');
        $data['user'] = $this->session->userdata('username');
        $data['payperiod'] = $this->payroll->get_specific_payperiod($id);
        $this->load->view('pages/payroll',$data);
		$this->load->view('footer');

	}

	 public function payperiod_list()
    {
        $list = $this->payroll->payperiod_get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payroll) {
            $no++;
            $row = array();
         

            $row[] = $payroll->period;
            $row[] = date("F j,Y", strtotime($payroll->date_from));
            $row[] = date("F j,Y", strtotime($payroll->date_to));
            $row[] = $payroll->total_gross;
            $row[] = $payroll->total_income;
            $row[] = $payroll->total_withholding_tax;
            $row[] = $payroll->total_deduction;

           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('payroll/payroll/'.$payroll->payperiod_id).'"><i class="glyphicon glyphicon-search"></i> View</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_payperiod('."'".$payroll->payperiod_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->payroll->payperiod_count_all(),
                        "recordsFiltered" => $this->payroll->payperiod_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

       public function payroll_table($date)
    {
        $list = $this->payroll->payslip_get_datatables($date);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payroll) {
            $no++;
            $row = array();
          
        $total_deductions = $payroll->sss_contrib + $payroll->hdmf_contrib + $payroll->philhealth_contrib;
        

           $row[] = ucfirst($payroll->lastname).', '.ucfirst($payroll->firstname).' '.ucfirst(substr($payroll->middlename,0,1)).'. ';
            $row[] = $payroll->position;
            $row[] = $payroll->department;
      
            $row[] = '&#x20B1; '.number_format($payroll->basic_salary,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->allowance,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->total_overtime_pay,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->gross_salary,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->deductions,2,'.',',');
            $row[] = '&#x20B1; '.number_format($total_deductions,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->withholding_tax,2,'.',',');
            $row[] = '&#x20B1; '.number_format($payroll->net_pay,2,'.',',');

           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('payroll/pdf/'.$payroll->user_id).'"><i class="glyphicon glyphicon-search"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_payperiod('."'".$payroll->user_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->payroll->payslip_count_all(),
                        "recordsFiltered" => $this->payroll->payslip_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

       public function payroll_data($id)
    {
        $list = $this->payroll->emp_payslip_get_datatables($id);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payroll) {
            $no++;
            $row = array();
         

           $row[] = ucfirst($payroll->lastname).', '.ucfirst($payroll->firstname).' '.ucfirst(substr($payroll->middlename,0,1)).'. ';
            $row[] = $payroll->position;
            $row[] = $payroll->department;
      
            $row[] = '&#x20B1; '.$payroll->salary;
            $row[] = $payroll->allowance;
            $row[] = $payroll->overtime_pay;
            $row[] = $payroll->gross_salary;
            $row[] = $payroll->deductions;
            $row[] = $payroll->deductions;
            $row[] = $payroll->withholding_tax;
            $row[] = $payroll->net_pay;

           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('payroll/payroll/'.$payroll->user_id).'"><i class="glyphicon glyphicon-search"></i> View</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_payperiod('."'".$payroll->user_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->payroll->payslip_count_all(),
                        "recordsFiltered" => $this->payroll->payslip_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	    public function add_payperiod()
    {
       
        $this->_validate();


         $first11 = date('Y-m-01');
         $last11 = date('Y-m-15');

         $first12 = date('Y-m-16');
         $last12= date('Y-m-t');



         $first21 = date('Y-m-01',strtotime('first day of next month'));
         $last21 = date('Y-m-15', strtotime('last day of next month'));

         $first22 = date('Y-m-16',strtotime('first day of next month'));
         $last22= date('Y-m-t',strtotime('last day of next month'));



         $first31 = date('Y-m-01',strtotime('first day of +2 month'));
         $last31 = date('Y-m-15',strtotime('last day of +2 month'));

         $first32 = date('Y-m-16',strtotime('first day of +2 month'));
         $last32= date('Y-m-t',strtotime('last day of +2 month'));



         $first41 = date('Y-m-01',strtotime('first day of +3 month'));
         $last41 = date('Y-m-15', strtotime('last day of +3 month'));

         $first42 = date('Y-m-16',strtotime('first day of +3 month'));
         $last42= date('Y-m-t',strtotime('last day of +3 month'));



         $first51 = date('Y-m-01',strtotime('first day of +4 month'));
         $last51 = date('Y-m-15', strtotime('last day of +4 month'));

         $first52 = date('Y-m-16',strtotime('first day of +4 month'));
         $last52= date('Y-m-t',strtotime('last day of +4 month'));



$startdate = $this->input->post('startdate');
$enddate = $this->input->post('enddate');
      $checkstart = true;
      $info="";

     if($startdate == $first11){
            if($enddate == $last11){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the 15th day of the month";
            }
      }else if($startdate == $first12){
            if($enddate == $last12){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
      }else if($startdate == $first21){
            if($enddate == $last21){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the 15th day of the month";
            }
      }else if($startdate == $first22){
            if($enddate == $last22){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
      }else if($startdate == $first31){
            if($enddate == $last31){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the 15th day of the month";
            }
      }else if($startdate == $first32){
            if($enddate == $last32){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
      }else if($startdate == $first41){
            if($enddate == $last41){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the 15th day of the month";
            }
      }else if($startdate == $first42){
            if($enddate == $last42){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
      }else if($startdate == $first51){
            if($enddate == $last51){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the 15th day of the month";
            }
      }else if($startdate == $first52){
            if($enddate == $last52){

              $checkstart = true;
            }else{

              $checkstart = false;
              $info = "End date must be the last day of the month";
            }
      }else{

          $checkstart = false;
          $info = "Start date must be the 1st/16th day of the month";
         }


        $list = $this->payroll->get_payperiod();

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
     

       if($checkstart  == true){
//


 $distinct_emplist = $this->payroll->get_distinct_employee($startdate,$enddate);

 if($distinct_emplist != false){

    foreach ($distinct_emplist as $employee) {
   
      $employee_id = $employee->user_id;

      $basic_salary = $employee->salary;
      $semi_monthly_salary = round($basic_salary/2,2);
      $daily_rate =  round(($basic_salary * 12)/261,2);
      $hourly_rate = round($daily_rate/8,2);

      $total_overtime_hours = 0;
      $tax_status = "";
      $taxable_income = 0;
      $total_hours_worked = 0;
      //                        
      $overtime_pay = 0;
      $ot_ordinary = 0;
      $ot_restday = 0;
      $ot_special_holiday = 0;
      $ot_regular_holiday = 0;
      $ot_double_holiday = 0;
      $ot_rest_special = 0;
      $ot_rest_regular = 0;
      $ot_rest_double = 0;
      $ot_nightdiff = 0;
      $night_shift_diff = 0;
      //
      $total_deduction = 0;
      $total_absent_dedcution = 0;
      $late_deduction = 0;
      $undertime_deduction = 0;
      $sss = 0;
      $pagibig = 0;
      $philhealth = 0;
      
        $emp_list =  $this->payroll->get_specific_emp_details($employee_id,$startdate,$enddate);

        foreach ($emp_list as  $value) {

          if($value->attendance_status == 'present'){

              if($value->work_status == 'overtime'){

                  if($value->overtime_type == 'ordinary'){

                    $ot_nightdiff += (($hourly_rate*1.25)*.10)*$value->night_diff_ot;
                    $ot_ordinary += ($value->overtime*$hourly_rate)*1.25;
                    $overtime_pay += ($value->overtime*$hourly_rate)*1.25;       

                  }else if($value->overtime_type == 'rest day'){

                    $ot_nightdiff += (($hourly_rate*1.3)*.10)*$value->night_diff_ot;
                    $rest_day_hourly_rate = $hourly_rate*1.3;
                    $ot_restday += ($value->overtime*$rest_day_hourly_rate)*1.30;
                    $overtime_pay += ($value->overtime*$rest_day_hourly_rate)*1.30;
                        
                  }else if($value->overtime_type == 'regular holiday'){

                    $ot_nightdiff += (($hourly_rate*2)*.10)*$value->night_diff_ot;
                    $regular_holiday_hourly_rate = $hourly_rate*2;
                    $ot_regular_holiday += ($value->overtime*$regular_holiday_hourly_rate)*1.30;
                    $overtime_pay += ($value->overtime*$regular_holiday_hourly_rate)*1.30;

                  }else if($value->overtime_type == 'special holiday'){

                    $ot_nightdiff += (($hourly_rate*1.3)*.10)*$value->night_diff_ot;
                    $special_holiday_hourly_rate = $hourly_rate*1.3;
                    $ot_special_holiday += ($value->overtime*$special_holiday_hourly_rate)*1.3;
                    $overtime_pay += ($value->overtime*$special_holiday_hourly_rate)*1.3;
                        
                  }else if($value->overtime_type == 'double holiday'){

                    $ot_nightdiff += (($hourly_rate*3)*.10)*$value->night_diff_ot;
                    $double_holiday_hourly_rate = $hourly_rate*3;
                    $ot_double_holiday += ($value->overtime*$double_holiday_hourly_rate)*3;   
                    $overtime_pay += ($value->overtime*$double_holiday_hourly_rate)*3;   

                  }else if($value->overtime_type == 'rest day/regular holiday'){

                    $ot_nightdiff += (($hourly_rate*2.6)*.10)*$value->night_diff_ot;
                    $rest_regular_holiday_hourly_rate = $hourly_rate*2.6;
                    $ot_rest_regular += ($value->overtime*$rest_regular_holiday_hourly_rate)*1.30;
                    $overtime_pay += ($value->overtime*$rest_regular_holiday_hourly_rate)*1.30;

                  }else if($value->overtime_type == 'rest day/special holiday'){

                    $ot_nightdiff += (($hourly_rate*1.5)*.10)*$value->night_diff_ot;
                    $rest_special_holiday_hourly_rate = $hourly_rate*1.5;
                    $ot_rest_special += ($value->overtime*$rest_special_holiday_hourly_rate)*1.30;
                    $overtime_pay += ($value->overtime*$rest_special_holiday_hourly_rate)*1.30;

                  }else if($value->overtime_type == 'rest day/double holiday'){

                    $ot_nightdiff += (($hourly_rate*3)*.10)*$value->night_diff_ot;
                    $rest_double_holiday_hourly_rate = $hourly_rate*3;
                    $ot_rest_double += ($value->overtime*$rest_double_holiday_hourly_rate)*3; 
                    $overtime_pay += ($value->overtime*$rest_double_holiday_hourly_rate)*3;                   

                  }

                 $total_overtime_hours += $value->overtime;

              }

              if($value->sched_type == "night shift"){

                $night_shift_diff += $hourly_rate*.10*8;

              }


              $undertime_deduction += $hourly_rate*$value->undertime;
              $late_deduction += $hourly_rate*$value->tardiness;


          }else if($value->attendance_status == 'absent'){

          
          $total_absent_dedcution += $hourly_rate*8;

          
          }

          $sss = $value->sss_employee/2;
          $pagibig = $value->pagibig_employee_share/2;
          $philhealth = $value->philhealth_employee/2;
          $tax_status = $value->taxstatus;
   
        }

        $overtime_pay += $ot_nightdiff;
        $overtime_pay += $night_shift_diff;
        $total_deduction = $sss + $pagibig + $philhealth + $total_absent_dedcution + $undertime_deduction                 + $late_deduction;

        $taxable_income = $basic_salary + $overtime_pay - $total_deduction;

        $tax_list = $this->payroll->get_tax($tax_status,$taxable_income);
       
        $minrange = $tax_list->minrange;
        $tax1 = $tax_list->tax1;
        $tax2 = $tax_list->tax2;

        $gross_salary = $basic_salary + $overtime_pay;

        $withholding_tax = (($taxable_income-$minrange)*$tax2)+$tax1;

        $net_pay = $taxable_income - $withholding_tax;


         $payslip_data = array(
              
            'user_id' => $employee_id,
            'period' => $enddate,
            'basic_salary' => $basic_salary,
            'allowance' => 0,
            'ordinary_ot_pay' => $ot_ordinary,
            'rest_day_pay' => $ot_restday,
            'special_holiday_pay' => $ot_special_holiday,
            'regular_holiday_pay' => $ot_regular_holiday,
            'double_holiday_pay' => $ot_double_holiday,
            'rest_special_holiday_pay' => $ot_rest_special,
            'rest_regular_holiday_pay' => $ot_rest_regular,
            'rest_double_holiday_pay' => $ot_rest_double,
            'night_diff_pay' => $ot_nightdiff,
            'total_overtime_pay' => $overtime_pay,
            'total_overtime_hours' => $total_overtime_hours,
            'gross_salary' => $gross_salary,
            'deductions' => $total_deduction,
            'sss_contrib' => $sss,
            'hdmf_contrib' => $pagibig,
            'philhealth_contrib' => $philhealth,
            'withholding_tax' => $withholding_tax,
            'sss_loan' => 0,
            'pagibig_loan' => 0,
            'others' => 0,
            'payslip_status' => 0,
            'net_pay' => $net_pay,
              

              );
          $insert = $this->payroll->payslip_save($payslip_data);

    }
  }
   
//

                	  $data = array(
			        
			        'date_from' => $this->input->post('startdate'),
			        'date_to' => $this->input->post('enddate'),
			        'period' => $this->input->post('enddate'),
			        'total_gross' => 0,
			        'total_income' => 0,
			        'total_withholding_tax' => 0,
			        'total_deduction' => 0,
			        

			        );
			    $insert1 = $this->payroll->payperiod_save($data);

                 echo json_encode(array("status" => TRUE));
      }
            else{

        echo json_encode(array("status" => TRUE, "warning" => true, "info" => $info));

   	 	}
    }


      public function delete_payperiod($id)
    {
        $this->payroll->payperiod_delete_by_id($id);
        echo json_encode(array("status" => TRUE));
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

    function pdf($id)
  {
    
        $this->load->helper('pdf_helper');
        $data['payslip'] = $this->payroll->get_payslip($id);
      
        $this->load->view('pdfreport',$data);
      
  }

}
?>
