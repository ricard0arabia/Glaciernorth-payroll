<?php


	class Payroll extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Contents','payperiod');
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
        $data['payperiod'] = $this->payperiod->get_specific_payperiod($id);
        $this->load->view('pages/payroll',$data);
		$this->load->view('footer');

	}

	 public function payperiod_list()
    {
        $list = $this->payperiod->payperiod_get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payperiod) {
            $no++;
            $row = array();
         

            $row[] = $payperiod->period;
            $row[] = date("F j,Y", strtotime($payperiod->date_from));
            $row[] = date("F j,Y", strtotime($payperiod->date_to));
            $row[] = $payperiod->total_gross;
            $row[] = $payperiod->total_income;
            $row[] = $payperiod->total_withholding_tax;
            $row[] = $payperiod->total_deduction;

           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" href="'.site_url('payroll/payroll/'.$payperiod->payperiod_id).'"><i class="glyphicon glyphicon-search"></i> View</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_payperiod('."'".$payperiod->payperiod_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->payperiod->payperiod_count_all(),
                        "recordsFiltered" => $this->payperiod->payperiod_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	    public function add_payperiod()
    {
       
        $this->_validate();

$startdate = $this->input->post('startdate');
$enddate = $this->input->post('enddate');
      $checkstart = true;
      $info="";

     if(date('d', strtotime($startdate)) == "1" || date('d',strtotime($startdate)) == "15"){
     	if(date('d',strtotime($enddate)) == "15" || date('d',strtotime($enddate)) == "28" ||
     		date('d',strtotime($enddate)) == "30" || date('d',strtotime($enddate)) == "31" || 
     		date('d',strtotime($enddate)) == "29"){

     		$checkstart = true;
     	}
     	else{

     		$checkstart = false;
     		$info = "End date must be the 15th or lst day of the month";
     	}

     }
     else{

     	$checkstart = false;
     	$info = "Start date must be the 1st or last day of the month";
     }


        $list = $this->payperiod->get_payperiod();

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
			        'total_gross' => 0,
			        'total_income' => 0,
			        'total_withholding_tax' => 0,
			        'total_deduction' => 0,
			        

			        );
			    $insert = $this->payperiod->payperiod_save($data);

                 echo json_encode(array("status" => TRUE));
            }
            else{

        echo json_encode(array("status" => TRUE, "warning" => true, "info" => $info));

   	 	}
    }


      public function delete_payperiod($id)
    {
        $this->payperiod->payperiod_delete_by_id($id);
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

}
?>
