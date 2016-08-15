$check = $this->leave->get_sched($this->session->userdata('username'));

       foreach ($check as $value) {
            if($this->input->post('startdate') == date_format($value->start,"Y-m-d")){

                $stat = true;
                break;
            }
       }
       if($stat == true){



        }else{

            echo json_encode(array("status" => false, "temp" => $stat));

        }

         $datetime = date_create($check->start);
        $date = date_format($datetime,"Y-m-d");
        echo $date;