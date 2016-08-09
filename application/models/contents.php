<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Contents extends CI_Model {


//============================= table for leave =========================================
 var $leave_table = 'rqst_leaves';
    var $leave_column_order = array('id','user_id','startdate','enddate','status','cause','duration','leavetype',null); //set column field database for datatable orderable
    var $leave_column_search = array('leavetype','status','startdate'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $leave_order = array('id' => 'desc'); // default order

//============================== table for overtime ======================================

    var $ot_table = 'rqst_overtime';
    var $ot_column_order = array('id','user_id','date','duration','cause','status',null); //set column field database for datatable orderable
    var $ot_column_search = array('date','cause','status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $ot_order = array('id' => 'desc'); // default

    var $empsched_table = 'emp_workschedule';
    var $empsched_column_order = array('id','user_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $empsched_column_search = array('mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $empsched_order = array('id' => 'desc'); // default

    var $shift_table = 'rqst_shift';
    var $shift_column_order = array('id','user_id','startdate','enddate','duration','shift_days','reason','status','sub_department','sub_position','sub_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $shift_column_search = array('sub_department','sub_position','sub_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $shift_order = array('id' => 'desc'); // default
	



 	var $emp_table = 'employees';
    var $emp_column_order = array('user_id','firstname','middlename','lastname','userlevel','emp_pass','department','position','contact_no','address','status','date_created',null); //set column field database for datatable orderable
    var $emp_column_search = array('firstname','lastname','position','department','userlevel'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $emp_order = array('user_id' => 'desc'); // def

    var $empinfo_table = 'employee_details';
    var $empinfo_column_order = array('emp_details_id','user_id','birthdate','gender','datehired','cstatus','salary','hdmf_no','tin_no','sss_no','philhealth_no',null); //set column field database for datatable orderable
    var $empinfo_column_search = array('user_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $empinfo_order = array('emp_details_id' => 'desc'); // def


   var $message_table = 'message';
    var $message_column_order = array('id','name','email','subject','message','created_at','read_status',null); //set column field database for datatable orderable
    var $message_column_search = array('name','email','subject'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $message_order = array('id' => 'desc'); // def



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

#emp_schedule
#emp_schedule
#emp_schedule


    	  private function empsched_get_datatables_query()
    {
    
       $this->db->from($this->empsched_table);
    	
        $i = 0;
     
        foreach ($this->empsched_column_search as $item) // loop column
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
 
                if(count($this->empsched_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->empsched_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->empsched_order))
        {
            $order = $this->empsched_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function empsched_get_datatables($id)
    {
        $this->empsched_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);  	
    	$this->db->where('user_id =', $id); 
        $query = $this->db->get();
        return $query->result();
    }
    function allempsched_get_datatables()
    {
        $this->empsched_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);  	
    	$this->db->where('user_id !=', $this->session->userdata('username')); 
        $query = $this->db->get();
        return $query->result();
    }
 
    function empsched_count_filtered()
    {
        $this->empsched_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function empsched_count_all()
    {
        $this->db->from($this->empsched_table);
        return $this->db->count_all_results();
    }
 
    public function empsched_get_by_id($id)
    {
        $this->db->from($this->empsched_table);
        $this->db->where('user_id =', $id); 
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function empsched_save($data)
    {
        $this->db->insert($this->empsched_table, $data);
        return $this->db->insert_id();
    }
 
    public function empsched_update($where, $data)
    {
        $this->db->update($this->empsched_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function empsched_delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->empsched_table);
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


// employee details
// employee details
// employee details
// employee details



    public function empinfo_count_all($id)
    {
    	$this->db->where('user_id',$id);
        $this->db->from($this->empinfo_table);
        return $this->db->count_all_results();
    }
 
    public function empinfo_get_by_id($id)
    {
        $this->db->from($this->empinfo_table);
        $this->db->where('user_id =', $id); 
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function empinfo_save($data)
    {
        $this->db->insert($this->empinfo_table, $data);
        return $this->db->insert_id();
    }
 
    public function empinfo_update($where, $data)
    {
        $this->db->update($this->empinfo_table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function empinfo_delete_by_id($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->empinfo_table);
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


		
 
	
}

?>