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
          $this->load->view('pages/reports',$data);
          $this->load->view('footer');

           }

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
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_reports_period('."'".$reports->reports_period_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
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

         $first2 = date('Y-m-01',strtotime( '+1 month' , strtotime ( date('Y-m-d') )));
         $last2= date('Y-m-t',strtotime( '+1 month' , strtotime ( date('Y-m-d') )));

         $first3 = date('Y-m-01',strtotime( '+2 month' , strtotime ( date('Y-m-d') )));
         $last3 = date('Y-m-t',strtotime( '+2 month' , strtotime ( date('Y-m-d') )));

         $first4 = date('Y-m-01',strtotime( '+3 month' , strtotime ( date('Y-m-d') )));
         $last4 = date('Y-m-t',strtotime( '+3 month' , strtotime ( date('Y-m-d') )));

         $first5 = date('Y-m-01',strtotime( '+4 month' , strtotime ( date('Y-m-d') )));
         $last5 = date('Y-m-t',strtotime( '+4 month' , strtotime ( date('Y-m-d') )));
         


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
         

           if($checkstart  == true){
            $data = array();
                    
                   
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

    public function delete_reports_period($id)
    {
        $this->reports->reports_period_delete_by_id($id);
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




   public function philhealth_table()
    {




        $list = $this->reports->philhealth_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();
        $row[] = $reports->min_salary;
         $row[] = $reports->max_salary;
          $row[] = $reports->employee;
           $row[] = $reports->employer;
     
           
         
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


//sss


   public function sss_reports()
    {




        $list = $this->reports->sss_report_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reports) {

            $no++;
            $row = array();

             $row[] = $reports->user_id;
       $row[] = ucfirst($reports->lastname).', '.ucfirst($reports->firstname).' '.ucfirst(substr($reports->middlename,0,1)).'. ';
       $row[] = '2016-08-29';
         $row[] = $reports->sss_no;
          $row[] = $reports->employee;
           $row[] = $reports->employer;
           $row[] = $reports->total;
      
           
         
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
         $row[] = $reports->min_salary;
         $row[] = $reports->max_salary;
          $row[] = $reports->employee;
           $row[] = $reports->employer;
           $row[] = $reports->total;
      
           
         
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
