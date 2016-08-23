 public function get_allsched($id)
    {

       
       
          $date = date('Y-m-d');
        $date = new DateTime($date);
        $week = $date->format("W");


        $year = date("Y");

        $day1 = 1;
        $day7 = 7;

        $startdate = date('Y-m-d', strtotime($year."W".$week.$day1));
 
        $enddate = date('Y-m-d', strtotime($year."W".$week.$day7));
    
       
        $enddate = $enddate.' '.'23:59:59';
       
       
       
       
       
      $schedule = $this->db->query("SELECT *
                                FROM schedule
                                WHERE start >= '2016-08-15' and 
                                start <= '2016-08-21' 
                                having COUNT(start) = 1
                               
                             
                                                  
       
                                                    ");


    if($schedule->num_rows() > 0) {
        return $schedule->result_array();
        } else {
            return false;
        }
       
        
    }

    public function count_distinct($id){

    $this->db->group_by('schedule.user_id');
   $query = $this->get_allsched($id);

    return count($query->result()); 
       
    }

    public function get_distinct($id){
        $this->db->group_by('schedule.user_id');
   return $this->get_allsched($id);
    
   
      

   
   
       
    }