<?php


	class Reports extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->helper('url');
			$this->load->model('Contents','reports');
		}

	//BIR

	public function bir(){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

      		$this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/bir_reports',$data);
      		$this->load->view('footer');

      	   }

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




    public function philhealth(){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

          $this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/philhealth_reports',$data);
          $this->load->view('footer');

           }

  }


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


    public function sss(){


          if($this->session->userdata('isLogin') == FALSE)
          {

          redirect('login/login_form');

          }else{

          $this->load->view('header');
          $data['level'] = $this->session->userdata('level');
          $data['user'] = $this->session->userdata('username');
          $this->load->view('pages/sss_reports',$data);
          $this->load->view('footer');

           }

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

}
?>
