<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Contents extends CI_Model {


//============================= table for leave =========================================
 var $leave_table = 'rqst_leaves';
    var $leave_column_order = array('id','user_id','startdate','enddate','status','cause','duration','leavetype',null); //set column field database for datatable orderable
    var $leave_column_search = array('leavetype','duration','leave_status','startdate','department','position','firstname','lastname'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $leave_order = array('id' => 'desc'); // default order

//============================== table for overtime ======================================

    var $ot_table = 'rqst_overtime';
    var $ot_column_order = array('id','user_id','date','duration','cause','status',null); //set column field database for datatable orderable
    var $ot_column_search = array('date','cause','overtime_status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $ot_order = array('id' => 'desc'); // default


    var $shift_table = 'rqst_shift';
    var $shift_column_order = array('id','user_id','startdate','enddate','duration','shift_days','reason','status','sub_department','sub_position','sub_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $shift_column_search = array('sub_department','sub_position','sub_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $shift_order = array('id' => 'desc'); // default
    



    var $emp_table = 'employees';
    var $emp_column_order = array('user_id','firstname','middlename','lastname','userlevel','emp_pass','department','position','zipcode','email','contact_no','address','birthdate','gender','datehired','cstatus','taxstatus','salary','hdmf_no','tin_no','sss_no','philhealth_no','status','date_created','img_name','thumb_name','ext','upload_date',null); //set column field database for datatable orderable
    var $emp_column_search = array('firstname','lastname','position','department','userlevel'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $emp_order = array('user_id' => 'desc'); // def

    


   var $message_table = 'message';
    var $message_column_order = array('id','name','email','subject','message','created_at','read_status',null); //set column field database for datatable orderable
    var $message_column_search = array('name','email','subject'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $message_order = array('id' => 'desc'); // def

var $time_table = 'timesheet';
    var $time_column_order = array('timesheet_id','date',null); //set column field database for datatable orderable
    var $time_column_search = array('date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $time_order = array('timesheet_id' => 'asc'); // default order


 var $attendance_table = 'attendance';
    var $attendance_column_order = array('attendance_id','user_id','date','time_in','time_out','hours_worked','overtime','tardiness','sched_type','work_status','overtime_type',null); //set column field database for datatable orderable
    var $attendance_column_search = array('lastname','department','position','firstname','date','sched_type','work_status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $attendance_order = array('attendance_id' => 'asc'); // default order


     var $payperiod_table = 'payperiod';
    var $payperiod_column_order = array('payperiod_id','date_from','date_to','payperiod_status','total_gross','total_income','total_withholding_tax','total_deduction',null); //set column field database for datatable orderable
    var $payperiod_column_search = array('date_to','date_from','sub_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $payperiod_order = array('payperiod_id' => 'asc'); // default


         var $bir_table = 'semi_birtable';
    var $bir_column_order = array('bir_id','taxstatus','dependents','minrange','maxrange','tax1','tax2',null); //set column field database for datatable orderable
    var $bir_column_search = array('taxstatus','dependents','minrange','maxrange'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $bir_order = array('bir_id' => 'asc'); // default


      var $sss_table = 'sss';
    var $sss_column_order = array('sss_id','sss_min_salary','sss_max_salary','sss_employer','sss_employee','sss_total',null); //set column field database for datatable orderable
    var $sss_column_search = array('sss_min_salary','sss_max_salary','sss_employer','sss_employee'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $sss_order = array('sss_id' => 'asc'); // default

      var $philhealth_table = 'philhealth_table';
    var $philhealth_column_order = array('philhealth_id','philhealth_min_salary','philhealth_max_salary','philhealth_employer','philhealth_employee','philhealth_total',null); //set column field database for datatable orderable
    var $philhealth_column_search = array('philhealth_min_salary','philhealth_max_salary','philhealth_employer','philhealth_employee'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $philhealth_order = array('philhealth_id' => 'asc'); // default

      var $payslip_table = 'payslip';
    var $payslip_column_order = array('payslip_id','user_id','basic_salary','allowance','overtime_pay','special_holiday_pay','legal_holiday_pay','night_diff_pay','gross_salary','deductions','sss_contrib','hdmf_contrib','philhealth_contrib','withholding_tax','sss_loan','pagibig_loan','others','payslip_status','net_pay',null); //set column field database for datatable orderable
    var $payslip_column_search = array('user_id','basic_salary'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $payslip_order = array('payslip_id' => 'asc'); // default


      var $reports_period_table = 'reports_period';
    var $reports_period_column_order = array('reports_period_id','date_from','date_to','total_employee_share','total_employer_share','total_share',null); //set column field database for datatable orderable
    var $reports_period_column_search = array('date_to','date_from'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $reports_period_order = array('reports_period_id' => 'asc'); // default
    

    public function __construct() {
        parent::__construct();
          $this->load->database();
    }       
    

    function add_image($data,$id) {
        $this->db->where('user_id', $id);
        $this->db->update('employees', $data); 
    }

    function get_image() {
            $getimage = $this->db->query("SELECT img_name, ext
                                        FROM employees
                                        WHERE user_id  = '".$this->uri->segment(3)."'
                                        ");
                                        
        if($getimage->num_rows() > 0) {
            return $getimage->result_array();
        } else {
            return false;       
        }
    }

    function get_image_profile($id) {
            $getimage = $this->db->query("SELECT img_name, ext
                                        FROM employees
                                        WHERE user_id  = '".$id."'
                                        ");
                                        
        if($getimage->num_rows() > 0) {
            return $getimage->result_array();
        } else {
            return false;       
        }
    }
   




#add leave request
#add leave request
#add leave request

      private function _get_datatables_query()
    {
        
        $this->db->from('rqst_leaves');
        $this->db->join('employees','employees.user_id = rqst_leaves.user_id');



  
        $i = 0;
     
        foreach ($this->leave_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {             
              if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->leave_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->leave_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->leave_order))
        {
            $order = $this->leave_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function rqst_get_datatables()
    {
        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_leaves.user_id', $this->session->userdata('username')); 
        $this->db->where('rqst_leaves.leave_status =', 'requested');
        $query = $this->db->get();
        return $query->result();
    }
     function leave_request_history_get_datatables()
    {
        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_leaves.user_id =', $this->session->userdata('username')); 
        $this->db->where('rqst_leaves.leave_status !=', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
 
    function approval_get_datatables()
    {
        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_leaves.user_id !=', $this->session->userdata('username')); 
        $this->db->where('rqst_leaves.leave_status =', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
    function leave_approval_history_get_datatables()
    {
        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_leaves.user_id !=', $this->session->userdata('username')); 
        $this->db->where('rqst_leaves.leave_status !=', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
    
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->leave_table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->leave_table);
        $this->db->where('leave_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->leave_table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->leave_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('leave_id', $id);
        $this->db->delete($this->leave_table);
    }
 

#add overtime request
#add overtime request
#add overtime request



          private function ot_get_datatables_query()
    {
         

       $this->db->from('rqst_overtime');
        $this->db->join('employees','employees.user_id = rqst_overtime.user_id');

 
        $i = 0;
     
        foreach ($this->ot_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->ot_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->ot_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->ot_order))
        {
            $order = $this->ot_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function ot_rqst_get_datatables()
    {
        
        $this->ot_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_overtime.user_id', $this->session->userdata('username')); 
        $this->db->where('rqst_overtime.ot_status =', 'requested');
        $query = $this->db->get();
        return $query->result();
    }
     function ot_request_history_get_datatables()
    {
        
        $this->ot_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_overtime.user_id =', $this->session->userdata('username')); 
        $this->db->where('rqst_overtime.ot_status !=', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
 
    function ot_approval_get_datatables()
    {
        
        $this->ot_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_overtime.user_id !=', $this->session->userdata('username')); 
        $this->db->where('rqst_overtime.ot_status =', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
    function ot_approval_history_get_datatables()
    {
        
        $this->ot_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('rqst_overtime.user_id !=', $this->session->userdata('username')); 
        $this->db->where('rqst_overtime.ot_status !=', 'requested'); 
        $query = $this->db->get();
        return $query->result();
    }
 
    function ot_count_filtered()
    {
        $this->ot_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function ot_count_all()
    {
        $this->db->from($this->ot_table);
        return $this->db->count_all_results();
    }
 
    public function ot_get_by_id($id)
    {
        $this->db->from($this->ot_table);
        $this->db->where('overtime_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function ot_save($data)
    {
        $this->db->insert($this->ot_table, $data);
        return $this->db->insert_id();
    }
 
    public function ot_update($where, $data)
    {
        $this->db->update($this->ot_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function ot_delete_by_id($id)
    {
        $this->db->where('overtime_id', $id);
        $this->db->delete($this->ot_table);
    }


#add shift change request
#add shift change request
#add shift change request



          private function shift_get_datatables_query()
    {
      
        $this->db->from($this->shift_table);

 
        $i = 0;
     
        foreach ($this->shift_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->shift_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->shift_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->shift_order))
        {
            $order = $this->shift_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function shift_get_datatables()
    {
        $this->shift_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function shift_count_filtered()
    {
        $this->shift_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function shift_count_all()
    {
        $this->db->from($this->shift_table);
        return $this->db->count_all_results();
    }
 
    public function shift_get_by_id($id)
    {
        $this->db->from($this->shift_table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function shift_save($data)
    {
        $this->db->insert($this->shift_table, $data);
        return $this->db->insert_id();
    }
 
    public function shift_update($where, $data)
    {
        $this->db->update($this->shift_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function shift_delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->shift_table);
    }


#emp_list
#emp_list
#emp_list


          private function emp_get_datatables_query()
    {
    
       $this->db->from($this->emp_table);
        
        $i = 0;
     
        foreach ($this->emp_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->emp_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->emp_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->emp_order))
        {
            $order = $this->emp_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function emp_get_datatables()
    {
        $this->emp_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $this->db->where('employees.user_id !=', $this->session->userdata('username')); 
        $query = $this->db->get();
        return $query->result();
    }

    public function get_emp_id()
    {
        $this->db->from('employees');
        $query = $this->db->get();
 
        return $query->result();
    }

    public function check_emp_id()
    {
        $this->db->from('employees');
         return $this->db->get();

    }
 
    function emp_count_filtered()
    {
        $this->emp_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function emp_count_all()
    {
        $this->db->from($this->emp_table);
        return $this->db->count_all_results();
    }
 
    public function emp_get_by_id($id)
    {
        $this->db->from($this->emp_table);
        $this->db->where('user_id =', $id); 
        $query = $this->db->get();
 
        return $query->row();
    }

      function emp_get_name($id) {
        $emp_get_name = $this->db->query("SELECT lastname, firstname, middlename
                                        FROM employees
                                        WHERE user_id = $id");
                                        
        return $emp_get_name->result_array();
    }
 
    public function emp_save($data)
    {
        $this->db->insert($this->emp_table, $data);
        return $this->db->insert_id();
    }
 
    public function emp_update($where, $data)
    {
        $this->db->update($this->emp_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function emp_delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->emp_table);
    }


    
//
    //
    //
    //


          private function message_datatables_query()
    {
    
       $this->db->from($this->message_table);
        
        $i = 0;
     
        foreach ($this->message_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->message_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->message_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->message_order))
        {
            $order = $this->message_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function message_get_datatables()
    {
        $this->message_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);     
        $query = $this->db->get();
        return $query->result();
    }
 
    function message_count_filtered()
    {
        $this->message_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function message_count_all()
    {
        $this->db->from($this->message_table);
        return $this->db->count_all_results();
    }
 
    public function message_get_by_id($id)
    {
        $this->db->from($this->message_table);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function message_save($data)
    {
        $this->db->insert($this->message_table, $data);
        return $this->db->insert_id();
    }
 
    public function message_update($where, $data)
    {
        $this->db->update($this->message_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function message_delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->message_table);
    }


///

    public function sched_save($data)
    {
        $this->db->insert('schedule', $data);
        return $this->db->insert_id();
    }
    public function sched_update($data,$user_id,$id)
    {   
        $this->db->where('user_id', $user_id);
        $this->db->where('sched_id', $id);
        $this->db->update('schedule', $data);
        return $this->db->affected_rows();
    }
     public function sched_update1($data,$user_id,$date)
    {   
        $this->db->where('user_id', $user_id);
       $this->db->where("start LIKE '$date%'"); 
        $this->db->update('schedule', $data);
        return $this->db->affected_rows();
    }
    public function get_sched($id)
    {
        $this->db->from('schedule');
        $this->db->where('user_id =', $id); 
        $query = $this->db->get();
 
        return $query->result();
    }

     public function get_emp_sched($id,$date)
    {
        $this->db->from('schedule');
        $this->db->where('user_id =', $id); 
        $this->db->where("start LIKE '$date%'"); 
        $query = $this->db->get();
 
        return $query->row();
    }

    public function get_leave_date($id){

        $this->db->from('rqst_leaves');
        $this->db->where('user_id =', $id); 
         $this->db->order_by('leave_id',"desc");
        $this->db->limit(1);
        $query = $this->db->get();
 
        return $query->row();
    }

     public function get_ot_date($id){

        $this->db->from('rqst_overtime');
        $this->db->where('user_id =', $id); 
        $this->db->order_by('overtime_id',"desc");
        $this->db->limit(1);
        $query = $this->db->get();
 
        return $query->row();
    }

      public function sched_count_all($id)
    {
        $this->db->from('schedule');
        $this->db->where('user_id', $id);
        return $this->db->count_all_results();
    }
//timesheet









          private function time_get_datatables_query()
    {
      
        $this->db->from($this->time_table);

 
        $i = 0;
     
        foreach ($this->time_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->time_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->time_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->time_order))
        {
            $order = $this->time_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function time_get_datatables()
    {
        $this->time_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_time()
    {
        $this->db->from('timesheet');
        $query = $this->db->get();
 
        return $query->result();
    }

     public function emp_get_time($id)
    {
        $this->db->from('timesheet');
        $this->db->where('timesheet_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    function time_count_filtered()
    {
        $this->time_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function time_count_all()
    {
        $this->db->from($this->time_table);
        return $this->db->count_all_results();
    }
 
    public function time_get_by_id($id)
    {
        $this->db->from($this->time_table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function time_save($data)
    {
        $this->db->insert($this->time_table, $data);
        return $this->db->insert_id();
    }
 
    public function time_update($where, $data)
    {
        $this->db->update($this->time_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function time_delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->time_table);
    }



//attendance

     private function attendance_get_datatables_query()
    {
      
         $this->db->from('attendance');
        $this->db->join('employees','employees.user_id = attendance.user_id');

 
        $i = 0;
     
        foreach ($this->attendance_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->attendance_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->attendance_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->attendance_order))
        {
            $order = $this->attendance_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function attendance_get_datatables($id, $date)
    {
       $this->attendance_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('attendance.user_id !=', $id);
        $this->db->where('attendance.date =', $date);

        
        $query = $this->db->get();
        return $query->result();
    }

     function emp_attendance_get_datatables($id)
    {
       $this->attendance_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('attendance.user_id =', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_attendance($id)
    {
        $this->db->from('attendance');
        $this->db->where('user_id !=', $id); 
        $query = $this->db->get();
 
        return $query->result();
    }

     public function get_emp_attendance($id)
    {
        $this->db->from('attendance');
        $this->db->where('user_id =', $id); 
        $query = $this->db->get();
 
        return $query->result();
    }

    function attendance_count_filtered()
    {
        $this->attendance_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function attendance_count_all()
    {
        $this->db->from($this->attendance_table);
        return $this->db->count_all_results();
    }
 
    public function attendance_get_by_id($id)
    {
        $this->db->from($this->attendance_table);
        $this->db->where('attendance_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function attendance_save($data)
    {
        $this->db->insert($this->attendance_table, $data);
        return $this->db->insert_id();
    }
 
    public function attendance_update($data,$user_id,$date)
    {
       $this->db->where('user_id', $user_id);
        $this->db->where('date', $date);
        $this->db->update('attendance', $data);
        return $this->db->affected_rows();
    }
 
    public function attendance_delete_by_id($id)
    {
        $this->db->where('attendance_id', $id);
        $this->db->delete($this->attendance_table);
    }

// payperiod


       private function payperiod_get_datatables_query()
    {
    
       $this->db->from($this->payperiod_table);
        
        $i = 0;
     
        foreach ($this->payperiod_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->payperiod_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->payperiod_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->payperiod_order))
        {
            $order = $this->payperiod_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function payperiod_get_datatables()
    {
        $this->payperiod_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $query = $this->db->get();
        return $query->result();
    }

      public function get_payperiod()
    {
        $this->db->from('payperiod');
        $query = $this->db->get();
 
        return $query->result();
    }

      public function  get_specific_payperiod($id)
    {
        $this->db->from('payperiod');
        $this->db->where('payperiod_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    function payperiod_count_filtered()
    {
        $this->payperiod_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function payperiod_count_all()
    {
        $this->db->from($this->payperiod_table);
        return $this->db->count_all_results();
    }
 
    public function payperiod_get_by_id($id)
    {
        $this->db->from($this->payperiod_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function payperiod_save($data)
    {
        $this->db->insert($this->payperiod_table, $data);
        return $this->db->insert_id();
    }
 
    public function payperiod_update($where, $data)
    {
        $this->db->update($this->payperiod_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function payperiod_delete_by_id($id)
    {
        $this->db->where('payperiod_id', $id);
        $this->db->delete($this->payperiod_table);
    }

// bir


       private function bir_get_datatables_query()
    {
    
       $this->db->from($this->bir_table);
        
        $i = 0;
     
        foreach ($this->bir_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->bir_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->bir_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->bir_order))
        {
            $order = $this->bir_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function bir_get_datatables()
    {
        $this->bir_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $query = $this->db->get();
        return $query->result();
    }

  
 
    function bir_count_filtered()
    {
        $this->bir_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function bir_count_all()
    {
        $this->db->from($this->bir_table);
        return $this->db->count_all_results();
    }
 
    public function bir_get_by_id($id)
    {
        $this->db->from($this->bir_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function bir_save($data)
    {
        $this->db->insert($this->bir_table, $data);
        return $this->db->insert_id();
    }
 
    public function bir_update($where, $data)
    {
        $this->db->update($this->bir_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function bir_delete_by_id($id)
    {
        $this->db->where('bir_id', $id);
        $this->db->delete($this->bir_table);
    }


// sss


       private function sss_get_datatables_query()
    {
    
       $this->db->from($this->sss_table);
      
        
        $i = 0;
     
        foreach ($this->sss_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->sss_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->sss_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->sss_order))
        {
            $order = $this->sss_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function sss_report_datatables_query()
    {
    
       $this->db->from('emp_contributions');
         $this->db->join('employees','employees.user_id = emp_contributions.user_id');
          $this->db->join('sss','sss.sss_id = emp_contributions.sss_code');
        
        $i = 0;
     
        foreach ($this->sss_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->sss_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->sss_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->sss_order))
        {
            $order = $this->sss_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function sss_get_datatables()
    {
        $this->sss_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $query = $this->db->get();
        return $query->result();
    }
     function sss_report_datatables($period)
    {
        $this->sss_report_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
         $this->db->where('emp_contributions.period =', $period);  
        $query = $this->db->get();
        return $query->result();
    }

  
 
    function sss_count_filtered()
    {
        $this->sss_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function sss_count_all()
    {
        $this->db->from($this->sss_table);
        return $this->db->count_all_results();
    }
 
    public function sss_get_by_id($id)
    {
        $this->db->from($this->sss_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function sss_save($data)
    {
        $this->db->insert($this->sss_table, $data);
        return $this->db->insert_id();
    }
 
    public function sss_update($where, $data)
    {
        $this->db->update($this->sss_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function sss_delete_by_id($id)
    {
        $this->db->where('sss_id', $id);
        $this->db->delete($this->sss_table);
    }




// philhealth


       private function philhealth_get_datatables_query()
    {
    
       $this->db->from($this->philhealth_table);
        
        $i = 0;
     
        foreach ($this->philhealth_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->philhealth_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->philhealth_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->philhealth_order))
        {
            $order = $this->philhealth_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

      private function philhealth_report_datatables_query()
    {
    
       $this->db->from('emp_contributions');
         $this->db->join('employees','employees.user_id = emp_contributions.user_id');
          $this->db->join('philhealth_table','philhealth_table.philhealth_id = emp_contributions.philhealth_code');
        
        $i = 0;
     
        foreach ($this->philhealth_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->philhealth_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->philhealth_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->philhealth_order))
        {
            $order = $this->philhealth_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
 
    function philhealth_get_datatables()
    {
        $this->philhealth_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $query = $this->db->get();
        return $query->result();
    }



        function philhealth_report_datatables($period)
    {
        $this->philhealth_report_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
         $this->db->where('emp_contributions.period =', $period);  
        $query = $this->db->get();
        return $query->result();
    }

  
 
    function philhealth_count_filtered()
    {
        $this->philhealth_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function philhealth_count_all()
    {
        $this->db->from($this->philhealth_table);
        return $this->db->count_all_results();
    }
 
    public function philhealth_get_by_id($id)
    {
        $this->db->from($this->philhealth_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function philhealth_save($data)
    {
        $this->db->insert($this->philhealth_table, $data);
        return $this->db->insert_id();
    }
 
    public function philhealth_update($where, $data)
    {
        $this->db->update($this->philhealth_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function philhealth_delete_by_id($id)
    {
        $this->db->where('philhealth_id', $id);
        $this->db->delete($this->philhealth_table);
    }

//payslip






       private function payslip_get_datatables_query()
    {
    
       $this->db->from('payslip');
        $this->db->join('employees','payslip.user_id = employees.user_id','right');
        
        $i = 0;
     
        foreach ($this->payslip_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->payslip_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->payslip_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->payslip_order))
        {
            $order = $this->payslip_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function payslip_get_datatables()
    {
        $this->payslip_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);   
    
        $query = $this->db->get();
        return $query->result();
    }

     function emp_payslip_get_datatables($id)
    {
        $this->payslip_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);   
        $this->db->where('payslip.user_id =', $id); 
        $query = $this->db->get();
        return $query->result();
    }

  
 
    function payslip_count_filtered()
    {
        $this->payslip_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function payslip_count_all()
    {
        $this->db->from($this->payslip_table);
        return $this->db->count_all_results();
    }
 
    public function payslip_get_by_id($id)
    {
        $this->db->from($this->payslip_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function payslip_save($data)
    {
        $this->db->insert($this->payslip_table, $data);
        return $this->db->insert_id();
    }
 
    public function payslip_update($where, $data)
    {
        $this->db->update($this->payslip_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function payslip_delete_by_id($id)
    {
        $this->db->where('payslip_id', $id);
        $this->db->delete($this->payslip_table);
    }


//reports period


      private function reports_period_get_datatables_query()
    {
    
       $this->db->from($this->reports_period_table);
        
        $i = 0;
     
        foreach ($this->reports_period_column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->reports_period_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->reports_period_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->reports_period_order))
        {
            $order = $this->reports_period_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function reports_period_get_datatables()
    {
        $this->reports_period_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);    
        $query = $this->db->get();
        return $query->result();
    }

      public function get_reports_period()
    {
        $this->db->from('reports_period');
        $query = $this->db->get();
 
        return $query->result();
    }

      public function  get_specific_reports_period($id)
    {
        $this->db->from('reports_period');
        $this->db->where('reports_period_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    function reports_period_count_filtered()
    {
        $this->reports_period_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function reports_period_count_all()
    {
        $this->db->from($this->reports_period_table);
        return $this->db->count_all_results();
    }
 
    public function reports_period_get_by_id($id)
    {
        $this->db->from($this->reports_period_table);
        $query = $this->db->get();
 
        return $query->row();
    }

  
 
    public function reports_period_save($data)
    {
        $this->db->insert($this->reports_period_table, $data);
        return $this->db->insert_id();
    }
 
    public function reports_period_update($where, $data)
    {
        $this->db->update($this->reports_period_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function reports_period_delete_by_id($id)
    {
        $this->db->where('reports_period_id', $id);
        $this->db->delete($this->reports_period_table);
    }




// emp_contribution



   public function get_emp_contributions($id)
    {
        $this->db->from('emp_contributions');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function check_emp_contributions($id)
    {
        $this->db->from('emp_contributions');
        $this->db->where('user_id',$id);
        return $this->db->get();
        
    }

     public function emp_contributions_update($data,$user_id,$date)
    {
       $this->db->where('user_id', $user_id);
        $this->db->where('period', $date);
        $this->db->update('emp_contributions', $data);
        return $this->db->affected_rows();
    }

     public function emp_contributions_save($data)
    {
        $this->db->insert('emp_contributions', $data);
        return $this->db->insert_id();
    }

     public function emp_contributions_delete_by_id($date)
    {
        $this->db->where('period', $date);
        $this->db->delete('emp_contributions');
    }
 





//




  public function get_holiday()
    {
        $this->db->from('holiday');
        $query = $this->db->get();
 
        return $query->result();
    }




//session

    public function takeUser($username, $password, $level)

        {

        $this->db->select('*');

        $this->db->from('employees');

        $this->db->where('user_id', $username);

        $this->db->where('emp_pass', $password);


        $this->db->where('userlevel', $level);

        $query = $this->db->get();

        return $query->num_rows();

        }

        public function userData($username)

        {


        $this->db->select('user_id');

        $this->db->where('user_id', $username);

        $query = $this->db->get('employees');

        return $query->row();

        }

Public function getEvents($id)
    {
        
    $sql = "SELECT * FROM schedule WHERE user_id = $id AND sched_type != 'day off' AND schedule.start BETWEEN ? AND ? ORDER BY schedule.start ASC";
    return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();

    }

/*Create new events */

    Public function addEvent()
    {

    $sql = "INSERT INTO events (title,events.date, description, color) VALUES (?,?,?,?)";
    $this->db->query($sql, array($_POST['title'], $_POST['date'], $_POST['description'], $_POST['color']));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    /*Update  event */

    Public function updateEvent()
    {

    $sql = "UPDATE events SET title = ?, events.date = ?, description = ?, color = ? WHERE id = ?";
    $this->db->query($sql, array($_POST['title'], $_POST['date'], $_POST['description'], $_POST['color'], $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }


    /*Delete event */

    Public function deleteEvent()
    {

    $sql = "DELETE FROM events WHERE id = ?";
    $this->db->query($sql, array($_GET['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    /*Update  event */

    Public function dragUpdateEvent()
    {
            $date=date('Y-m-d h:i:s',strtotime($_POST['date']));

            $sql = "UPDATE events SET  events.date = ? WHERE id = ?";
            $this->db->query($sql, array($date, $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;


    }

        
 
    
}

?>