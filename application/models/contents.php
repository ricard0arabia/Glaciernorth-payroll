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



    var $shift_table = 'rqst_shift';
    var $shift_column_order = array('id','user_id','startdate','enddate','duration','shift_days','reason','status','sub_department','sub_position','sub_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $shift_column_search = array('sub_department','sub_position','sub_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $shift_order = array('id' => 'desc'); // default

       var $emp_table = 'emp_workschedule';
    var $emp_column_order = array('id','user_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $emp_column_search = array('user_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $emp_order = array('id' => 'desc'); // default



	#build constructor

	public function __construct() {
		parent::__construct();
		  $this->load->database();
	}		
	

	function add_image($data,$id) {
		$this->db->where('user_id', $id);
		$this->db->update('employee_details', $data); 
	}

	function get_image() {
			$getimage = $this->db->query("SELECT img_name, ext
										FROM employee_details
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
										FROM employee_details
										WHERE user_id  = '".$id."'
										");
										
		if($getimage->num_rows() > 0) {
			return $getimage->result_array();
		} else {
			return false;		
		}
	}
   
	
	#this will get the user to login
	function getLogin() {
		$exeLogin = $this->db->query("SELECT * 
									FROM employees 
									WHERE status 	= 1								
									AND employeeid 	= ".$this->db->escape($this->input->post('employeeid'))."
									AND emp_pass 		= ".$this->db->escape(md5($this->input->post('userpass')))." ");									

		if($exeLogin->num_rows() > 0) {
			return $exeLogin->result_array();
		} else {
			return false;		
		}
	}


	#this will update the user account
	function exeUpdateAccount($userId) {			
		$exeUpdateAcct = $this->db->query("UPDATE tbl_user a, tbl_user_details b
									SET	a.sssid			= ".$this->db->escape(ucwords($_POST['sssId'])).",
										a.email_address	= ".$this->db->escape($_POST['emailAdd']).",		
										a.firstname 		= ".$this->db->escape(ucwords($_POST['fname'])).",
										a.middlename 		= ".$this->db->escape(ucwords($_POST['mname'])).", 	
										a.lastname 		= ".$this->db->escape(ucwords($_POST['lname'])).",
										a.modify_date		= '". date_default_timezone_set('America/New_York').",		
										a.modify_user_id	= ".$this->db->escape($_SESSION['userId']).",
										b.birthdate 		= ".$this->db->escape($_POST['birthYear']).",
										b.gender			= ".$this->db->escape($_POST['gender']).",										
										b.civil_status	= ".$this->db->escape($_POST['cStatus']).",
										b.cmpy_name		= ".$this->db->escape($_POST['cmpyName']).",
										b.job_title 		= ".$this->db->escape($_POST['jobTitle']).",
										b.country_name 	= ".$this->db->escape($_POST['ctryName']).",													
										b.home_address	= ".$this->db->escape($_POST['addr1']).",											
										b.city_name 		= ".$this->db->escape($_POST['cityName']).",
										b.zipcode			= ".$this->db->escape($_POST['zipCode']).",
										b.country_name	= ".$this->db->escape($_POST['ctryName']).",																		
										b.office_telno 	= ".$this->db->escape($_POST['officeNo']).",
										b.mobile_no 		= ".$this->db->escape($_POST['mobileNo']).",	
										b.landline_no		= ".$this->db->escape($_POST['phone1']).",									
										b.modify_date		= '". date_default_timezone_set('America/New_York').",								
										b.modify_user_id	= ".$this->db->escape($_SESSION['userId'])."	
										b.cstatus 	= ".$this->db->escape($_POST['civilStatus']).",

										b.department 	= ".$this->db->escape($_POST['department']).",
										b.contact_no 	= ".$this->db->escape($_POST['contact_no']).",

										b.hdmf_no 	= ".$this->db->escape($_POST['hdmf_no']).",
										b.tin_no 	= ".$this->db->escape($_POST['tin_no']).",
										b.sss_no 	= ".$this->db->escape($_POST['sss_no']).",
										b.philhealth_no 	= ".$this->db->escape($_POST['philhealth_no'])."'
										
									WHERE a.user_id  		= ".$this->db->escape($userId)." AND b.user_id  = ".$this->db->escape($userId)." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}
	
	#this will update the password
	function exeUpdatePassword($userId) {
		$exeUpdatePassword = $this->db->query("UPDATE employees
									SET emp_pass 		= ".$this->db->escape(md5($_POST['newPass']))."								
									WHERE user_id		= ".$this->db->escape($userId)." ");	
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will retrieve the total number of employees
	function exeGetTotalEmp() {		
		$exeGetTotalEmp = $this->db->query("SELECT *
										FROM employees
										WHERE status  = 1
										ORDER BY firstname ASC, lastname ASC");
										
		return $exeGetTotalEmp->num_rows();	
	}
	
	#this will retrieve the employees lists
	function exeGetAllEmployees() {
		$exeGetAllEmployees = $this->db->query("SELECT *
										FROM employees
										WHERE status  >= 0
										ORDER BY firstname ASC, lastname ASC");
										
		return $exeGetAllEmployees->result_array();
	}

	#this will retrieve the employee to update
	function exeGetEmpToEdit($userid) {
		$exeGetEmpToEdit = $this->db->query("SELECT *
										FROM employees a
										LEFT JOIN employee_details b
										ON a.user_id = b.user_id
										WHERE a.status >=0
										AND a.user_id  = '". $userid ."' ");
										
		if($exeGetEmpToEdit->num_rows() > 0) {
			return $exeGetEmpToEdit->result_array();
		} else {
			return false;
		}
	}

	#this will retrieve the user level
	function exeGetUserLevel() {
		$exeGetUserLevel = $this->db->query("SELECT *
										FROM userlevel										
										WHERE status = 1 ");
										
		if($exeGetUserLevel->num_rows() > 0) {
			return $exeGetUserLevel->result_array();
		} else {
			return false;
		}
	}
	function exeGetUserStatus() {
		$exeGetUserStatus = $this->db->query("SELECT *
										FROM emp_status	");
										
		if($exeGetUserStatus->num_rows() > 0) {
			return $exeGetUserStatus->result_array();
		} else {
			return false;
		}
	}

	function exeGetEmpDept() {
		$exeGetEmpDept = $this->db->query("SELECT *
										FROM department	");
										
		if($exeGetEmpDept->num_rows() > 0) {
			return $exeGetEmpDept->result_array();
		} else {
			return false;
		}
	}
	
	#this will retrieve the employees information
	function exeGetUserInfo($editId) {
		$exeGetUserInfo = $this->db->query("SELECT *
										FROM employee_details										
										WHERE user_id  = '". $editId ."' ");
										
		if($exeGetUserInfo->num_rows() > 0) {
			return $exeGetUserInfo->result_array();
		} else {
			return false;
		}
	}

	#this will add new record
	function exeAddNewRecord() {
		$exeaddrecord = $this->db->query("INSERT INTO employees
									SET	emailadd	= ".$this->db->escape($_POST['emailadd']).",		
										firstname 	= ".$this->db->escape(ucwords($_POST['fname'])).",
										middlename 	= ".$this->db->escape(ucwords($_POST['mname'])).", 	
										lastname 	= ".$this->db->escape(ucwords($_POST['lname'])).",
										userlevel	= ".$this->db->escape($_POST['userLevel']).",
										employeeid	= ".$this->db->escape($_POST['empno']).",
										emp_pass	= ".$this->db->escape(md5($_POST['empass']))." ");

		$maxid = 0;
		$row = $this->db->query('SELECT MAX(user_id) AS maxid FROM employees')->row();
		if ($row) {
		    $maxid = $row->maxid; 
		}

		$exeaddrecord = $this->db->query("INSERT INTO employee_details 
									SET user_id 	= ". $maxid .",
										birthdate 	= ".$this->db->escape($_POST['bdate']).",
										gender		= ".$this->db->escape($_POST['gender']).",										
										jobtitle	= ".$this->db->escape($_POST['jobtitle']).",
										datehired	= ".$this->db->escape($_POST['datehired']).",
										salary 		= ".$this->db->escape($_POST['salary']).",
										address 	= ".$this->db->escape($_POST['address']).",
										incase_emergency 	= ".$this->db->escape($_POST['contperson']).",
										emergency_no 	= ".$this->db->escape($_POST['emernumber']).",
										cstatus 	= ".$this->db->escape($_POST['civilStatus']).",
										department 	= ".$this->db->escape($_POST['department']).",
										contact_no 	= ".$this->db->escape($_POST['contact_no']).",
										hdmf_no 	= ".$this->db->escape($_POST['hdmf_no']).",
										tin_no 	= ".$this->db->escape($_POST['tin_no']).",
										sss_no 	= ".$this->db->escape($_POST['sss_no']).",
										philhealth_no 	= ".$this->db->escape($_POST['philhealth_no'])."										");

		$info = $this->db->query("SELECT * FROM employee_details WHERE user_id  = ". $maxid ." ");
	
		$info2 = $info->result_array();
		$salary = $info2[0]['salary'];
	
		$selcont = $this->db->query("SELECT employee
										FROM sss										
										WHERE min_salary  < ". $salary ." AND max_salary > ". $salary. " ");
	
		$selcont2 = $selcont->result_array();
		$ssscont = $selcont2[0]['employee'];
		
		$selcont3 = $this->db->query("SELECT employee
										FROM philhealth_table										
										WHERE min_salary  <= ". $salary ." AND max_salary > ". $salary. " ");
										
		$selcont4 = $selcont3->result_array();
		$philhealth = $selcont4[0]['employee'];
		
		$pagibig = $salary/2*.02;
		
		$check = $this->db->query("SELECT * FROM emp_contributions WHERE user_id  = ". $maxid ." ");
		if($check->num_rows() > 0) {
			return false;
		} else {
			$exeAddEmpContri = $this->db->query("INSERT INTO emp_contributions
										SET	user_id		= ".$this->db->escape($maxid).",		
											sss 		= ".$this->db->escape($ssscont).",
											philhealth 	= ".$this->db->escape($philhealth).", 
											pagibig 	= ".$this->db->escape($pagibig).", 
											status		= 1 ");
	
			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;
		}		
	}

	#this will save the employees information
	function exeSaveUserInfo($userId) {
		if($this->uri->segment(1) == 'userprofile') {
			$exeupdateinfo = $this->db->query("UPDATE employees a,employee_details b
									SET	a.emailadd		= ".$this->db->escape($_POST['emailadd']).",		
										a.firstname 	= ".$this->db->escape(ucwords($_POST['fname'])).",
										a.middlename 	= ".$this->db->escape(ucwords($_POST['mname'])).", 	
										a.lastname 		= ".$this->db->escape(ucwords($_POST['lname'])).",
										b.birthdate 	= ".$this->db->escape($_POST['bdate']).",
										b.gender		= ".$this->db->escape($_POST['gender']).",										
										b.jobtitle		= ".$this->db->escape($_POST['jobtitle']).",
										b.address 		= ".$this->db->escape($_POST['address']).",
										b.incase_emergency 	= ".$this->db->escape($_POST['contperson']).",
										b.emergency_no 	= ".$this->db->escape($_POST['emernumber']).",
										b.cstatus 	= ".$this->db->escape($_POST['civilStatus']).",

										b.department 	= ".$this->db->escape($_POST['department']).",
										b.contact_no 	= ".$this->db->escape($_POST['contact_no']).",

										b.hdmf_no 	= ".$this->db->escape($_POST['hdmf_no']).",
										b.tin_no 	= ".$this->db->escape($_POST['tin_no']).",
										b.sss_no 	= ".$this->db->escape($_POST['sss_no']).",
										b.philhealth_no 	= ".$this->db->escape($_POST['philhealth_no'])."' 
									WHERE a.user_id  	= ".$this->db->escape($userId)." AND b.user_id = ".$this->db->escape($userId)."");
		} else {
			$exeupdateinfo = $this->db->query("UPDATE employees a,employee_details b
									SET	a.emailadd		= ".$this->db->escape($_POST['emailadd']).",		
										a.firstname 	= ".$this->db->escape(ucwords($_POST['fname'])).",
										a.middlename 	= ".$this->db->escape(ucwords($_POST['mname'])).", 	
										a.lastname 		= ".$this->db->escape(ucwords($_POST['lname'])).",
										a.userLevel     = ".$this->db->escape($_POST['userLevel']).",
										a.employeeid	= ".$this->db->escape($_POST['empno']).",
										b.birthdate 	= ".$this->db->escape($_POST['bdate']).",
										b.gender		= ".$this->db->escape($_POST['gender']).",										
										b.jobtitle		= ".$this->db->escape($_POST['jobtitle']).",
										b.datehired		= ".$this->db->escape($_POST['datehired']).",
										b.salary 		= ".$this->db->escape($_POST['salary']).",
										b.address 		= ".$this->db->escape($_POST['address']).",
										b.incase_emergency 	= ".$this->db->escape($_POST['contperson']).",
										b.emergency_no 	= ".$this->db->escape($_POST['emernumber']).",
										b.cstatus 	= ".$this->db->escape($_POST['civilStatus']).",

										b.department 	= ".$this->db->escape($_POST['department']).",
										b.contact_no 	= ".$this->db->escape($_POST['contact_no']).",
										b.hdmf_no 	= ".$this->db->escape($_POST['hdmf_no']).",
										b.tin_no 	= ".$this->db->escape($_POST['tin_no']).",
										b.sss_no 	= ".$this->db->escape($_POST['sss_no']).",
										b.philhealth_no 	= ".$this->db->escape($_POST['philhealth_no'])."'

									WHERE a.user_id  	= ".$this->db->escape($userId)." AND b.user_id = ".$this->db->escape($userId)."");	
									
				$info = $this->db->query("SELECT * FROM employee_details WHERE user_id  = ".$this->db->escape($userId)." ");
		
				$info2 = $info->result_array();
				$salary = $info2[0]['salary'];
			
				$selcont = $this->db->query("SELECT employee
												FROM sss										
												WHERE min_salary  < ". $salary ." AND max_salary > ". $salary. " ");
			
				$selcont2 = $selcont->result_array();
				$ssscont = $selcont2[0]['employee'];
				
				$selcont3 = $this->db->query("SELECT employee
												FROM philhealth_table										
												WHERE min_salary  <= ". $salary ." AND max_salary > ". $salary. " ");
												
				$selcont4 = $selcont3->result_array();
				$philhealth = $selcont4[0]['employee'];
				
				$pagibig = $salary/2*.02;
				
				$exeAddEmpContri = $this->db->query("UPDATE  emp_contributions
											SET	sss 		= ".$this->db->escape($ssscont).",
												philhealth 	= ".$this->db->escape($philhealth).", 
												pagibig 	= ".$this->db->escape($pagibig)."
											WHERE user_id	= ".$this->db->escape($userId)." ");
		}

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}

	#this will delete the employee record
	function exeDeleteRecord($userId) {
		$exeDeleteRecord = $this->db->query("DELETE a, b, c, d, e, f
										FROM employees a 
										LEFT JOIN employee_details b 
										ON a.user_id = b.user_id
										LEFT JOIN emp_contributions c
										ON a.user_id = c.user_id
										LEFT JOIN overtime d
										ON a.user_id = d.user_id
										LEFT JOIN absences e
										ON a.user_id = e.user_id
										LEFT JOIN report f
										ON a.user_id = f.user_id
										WHERE a.user_id	= ".$this->db->escape($userId)." OR b.user_id	= ".$this->db->escape($userId)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	function exeGetSSS() {
		$exeGetSSS = $this->db->query("SELECT *
										FROM sss");
										
		if($exeGetSSS->num_rows() > 0) {
			return $exeGetSSS->result_array();
		} else {
			return false;
		}
	}

	function exeGetSSSToEdit($id) {
		$exeGetSSSToEdit = $this->db->query("SELECT *
										FROM sss										
										WHERE id  = ". $id ."  ");
										
		if($exeGetSSSToEdit->num_rows() > 0) {
			return $exeGetSSSToEdit->result_array();
		} else {
			return false;
		}
	}

	#this will add new record
	function exeAddNewSSS() {
		$exeAddNewSSS = $this->db->query("INSERT INTO sss
									SET	min_salary	= ".$this->db->escape($_POST['minsal']).",		
										max_salary 	= ".$this->db->escape(ucwords($_POST['maxsal'])).",
										employer 	= ".$this->db->escape(ucwords($_POST['empshare'])).", 	
										employee 	= ".$this->db->escape(ucwords($_POST['emplshare'])).",
										total		= ".$this->db->escape($_POST['total']).",
										status		= ".$this->db->escape($_POST['status'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will update sss contribution
	function exeUpdateSSSRecord($id) {
		$exeUpdateSSSRecord = $this->db->query("UPDATE sss
									SET	min_salary	= ".$this->db->escape($_POST['minsal']).",		
										max_salary 	= ".$this->db->escape($_POST['maxsal']).",
										employer 	= ".$this->db->escape($_POST['empshare']).", 	
										employee 	= ".$this->db->escape($_POST['emplshare']).",
										total		= ".$this->db->escape($_POST['total']).",
										status		= ".$this->db->escape($_POST['status'])."
									WHERE id 		= ".$this->db->escape($id)." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will delete the sss record
	function exeDeleteSSSRecord($id) {
		$exeDeleteSSSRecord = $this->db->query("DELETE 
										FROM sss
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#get the list of pay periods
	function exeGetPayperiod() {
		$exeGetPayperiod = $this->db->query("SELECT *
										FROM payperiod
										ORDER BY id DESC");
										
		if($exeGetPayperiod->num_rows() > 0) {
			return $exeGetPayperiod->result_array();
		} else {
			return false;
		}
	}

	#this will add new record on pay period
	function exeAddNewPayperiod() {
		$exeAddNewPayperiod = $this->db->query("INSERT INTO payperiod
									SET	payfrom		= ".$this->db->escape($_POST['payfrom']).",		
										payto 		= ".$this->db->escape($_POST['payto']).",
										monthend 	= ".$this->db->escape($_POST['monthend']).", 
										status		= ".$this->db->escape($_POST['status'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	function exeGetPayperiodToEdit($id) {
		$exeGetPayperiodToEdit = $this->db->query("SELECT *
										FROM payperiod										
										WHERE id  = ". $id ."  ");
										
		if($exeGetPayperiodToEdit->num_rows() > 0) {
			return $exeGetPayperiodToEdit->result_array();
		} else {
			return false;
		}
	}

	#this will update record on pay period
	function exeUpdatePayperiod($id) {
		$exeUpdatePayperiod = $this->db->query("UPDATE payperiod
									SET	payfrom		= ".$this->db->escape($_POST['payfrom']).",		
										payto 		= ".$this->db->escape($_POST['payto']).",
										monthend 	= ".$this->db->escape($_POST['monthend']).", 
										status		= ".$this->db->escape($_POST['status'])."
									WHERE id 		= ".$this->db->escape($id)." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will delete the pay period record
	function exeDeletePayperiod($id) {
		$exeDeletePayperiod = $this->db->query("DELETE 
										FROM payperiod
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#get the list of employees
	function exeGetEmployeeList() {
		$exeGetEmployeeList = $this->db->query("SELECT *
										FROM employees a
										LEFT JOIN employee_details b
										ON a.user_id = b.user_id 
										WHERE a.status >=0");
										
		if($exeGetEmployeeList->num_rows() > 0) {
			return $exeGetEmployeeList->result_array();
		} else {
			return false;
		}
	}

		function exeGetEmployeeListPrint($dept) {
		$exeGetEmployeeListPrint = $this->db->query("SELECT *
										FROM employees a
										LEFT JOIN employee_details b
										ON a.user_id = b.user_id 
										WHERE a.status >=0 and b.department = '$dept'");
										
		if($exeGetEmployeeListPrint->num_rows() > 0) {
			return $exeGetEmployeeListPrint->result_array();
		} else {
			return false;
		}
	}

	#get the mandatory employees contributions
	function exeGetMandatoryContri() {
		$exeGetMandatoryContri = $this->db->query("SELECT *
										FROM emp_contributions a
										LEFT JOIN employees b
										ON a.user_id = b.user_id
										WHERE b.status >= 0");
										
		if($exeGetMandatoryContri->num_rows() > 0) {
			return $exeGetMandatoryContri->result_array();
		} else {
			return false;
		}
	}

	#this will add new record on employees contributions
	function exeAddEmpContri() {
		$info = $this->db->query("SELECT * FROM employee_details WHERE user_id  = ". $_POST['empid'] ." ");

		$info2 = $info->result_array();
		$salary = $info2[0]['salary'];

		$selcont = $this->db->query("SELECT employee
										FROM sss										
										WHERE min_salary  < ". $salary ." AND max_salary > ". $salary. " ");

		$selcont2 = $selcont->result_array();
		$ssscont = $selcont2[0]['employee'];
		
		$selcont3 = $this->db->query("SELECT employee
										FROM philhealth_table										
										WHERE min_salary  <= ". $salary ." AND max_salary > ". $salary. " ");
										
		$selcont4 = $selcont3->result_array();
		$philhealth = $selcont4[0]['employee'];
		
		$pagibig = $salary/2*.02;
		
		$check = $this->db->query("SELECT * FROM emp_contributions WHERE user_id  = ". $_POST['empid'] ." ");
		if($check->num_rows() > 0) {
			return false;
		} else {
			$exeAddEmpContri = $this->db->query("INSERT INTO emp_contributions
										SET	user_id		= ".$this->db->escape($_POST['empid']).",		
											sss 		= ".$this->db->escape($ssscont).",
											philhealth 	= ".$this->db->escape($philhealth).", 
											pagibig 	= ".$this->db->escape($pagibig).", 
											status		= ".$this->db->escape($_POST['status'])." ");
	
			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;
		}
	}

	#get the mandatory employees contributions to edit
	function exeGetMandatoryContriEdit($id) {
		if($this->uri->segment(1) == 'mandatory' || $this->uri->segment(1) == 'overtime' || $this->uri->segment(1) == 'absences' || $this->uri->segment(1) == 'report') {
			$where = " WHERE a.user_id = ".$this->db->escape($id)." ";
		} else {
			$where = " WHERE a.id = ".$this->db->escape($id)." ";
		}
		$exeGetMandatoryContriEdit = $this->db->query("SELECT *
										FROM emp_contributions a
										LEFT JOIN employees b
										ON a.user_id = b.user_id
										LEFT JOIN employee_details c
										ON c.user_id = b.user_id
										$where ");
										
		if($exeGetMandatoryContriEdit->num_rows() > 0) {
			return $exeGetMandatoryContriEdit->result_array();
		} else {
			return false;
		}
	}

	#this will update employees contributions
	function exeUpdateEmpContri() {
		$exeUpdateEmpContri = $this->db->query("UPDATE emp_contributions
									SET	philhealth 	= ".$this->db->escape($_POST['philhealth']).", 
										pagibig 	= ".$this->db->escape($_POST['pagibig']).", 
										status		= ".$this->db->escape($_POST['status'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will delete the mandatory contributions
	function exeDeleteEmpContri($id) {
		$exeDeleteEmpContri = $this->db->query("DELETE 
										FROM emp_contributions
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will get the transaction list
	function exeGetTransactions() {
		$exeGetTransactions = $this->db->query("SELECT *
										FROM transactions ");
										
		if($exeGetTransactions->num_rows() > 0) {
			return $exeGetTransactions->result_array();
		} else {
			return false;
		}	
	}

	#this will get the transaction to edit
	function exeGetTransactToEdit($id) {
		$exeGetTransactToEdit = $this->db->query("SELECT *
										FROM transactions 
										WHERE id	= ".$this->db->escape($id)." ");
										
		if($exeGetTransactToEdit->num_rows() > 0) {
			return $exeGetTransactToEdit->result_array();
		} else {
			return false;
		}	
	}

	#this will get the overtime
	function exetGetOvertime($payid) {
		if($this->uri->segment(5) != '') {
			$and = " AND a.user_id = ".$this->db->escape($this->uri->segment(5))." ";
		} else {
			if($_SESSION['userLevel'] != 1 ) {
				$and = " AND b.user_id = ".$this->db->escape($_SESSION['userId'])." ";
			} else {
				$and = "";	
			}
		}
		$exetGetOvertime = $this->db->query("SELECT *
										FROM overtime a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										WHERE a.payperiod = ".$this->db->escape($payid)."
										$and ");

		if($exetGetOvertime->num_rows() > 0) {
			return $exetGetOvertime->result_array();
		} else {
			return true;
		}	
	}

	#this will add employees overtime
	function exeAddEmpOvertime() {
		$exetGetOvertime = $this->db->query("SELECT *
										FROM overtime
										WHERE payperiod = '". $this->uri->segment(3)."
										AND user_id 	= ".$this->db->escape($_POST['userid'])." ");

		if($exetGetOvertime->num_rows() > 0) {
			return false;
		} else {
			$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($_POST['userid'])." ");
										
			$check = $checkemp->result_array();
			$salary = $check[0]['salary'];
			
			// 22 working days in a month
			$rate_per_day = $salary / 22;
			
			// rate per hour
			$rate_per_hour = $rate_per_day / 8;
			
			$otrate = $rate_per_hour * $_POST['hours'];
									
			$exeAddEmpOvertime = $this->db->query("INSERT INTO overtime
										SET user_id 	= ".$this->db->escape($_POST['userid']).",
											payperiod 	= '". $this->uri->segment(3)."',
											hours 		= ".$this->db->escape($_POST['hours']).",
											rate 		= ".$this->db->escape($otrate).",
											status		= ".$this->db->escape($_POST['status'])." ");

			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;	
		}	
	}

	#this will get the overtime
	function exetGetOvertimeToEdit($payid,$userid) {
		$exetGetOvertimeToEdit = $this->db->query("SELECT *
										FROM overtime 
										WHERE payperiod = ".$this->db->escape($payid)."
										AND user_id 	= ".$this->db->escape($userid)." ");

		if($exetGetOvertimeToEdit->num_rows() > 0) {
			return $exetGetOvertimeToEdit->result_array();
		} else {
			return false;
		}	
	}

	#this will update employees overtime
	function exeUpdateEmpOvertime($payperiod,$empid) {
		$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($empid)." ");
										
		$check = $checkemp->result_array();
		$salary = $check[0]['salary'];
		
		// 22 working days in a month
		$rate_per_day = $salary / 22;
		
		// rate per hour
		$rate_per_hour = $rate_per_day / 8;
		
		$otrate = $rate_per_hour * $_POST['hours'];
		
		$exeUpdateEmpOvertime = $this->db->query("UPDATE overtime
										SET hours 		= ".$this->db->escape($_POST['hours']).",
											rate 		= ".$this->db->escape($otrate).",
											status		= ".$this->db->escape($_POST['status'])."
										WHERE payperiod = ".$this->db->escape($payperiod)." 
										AND user_id 	= ".$this->db->escape($empid)."  ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}

	#this will delete the employees overtime
	function exeDeleteOvertime($id) {
		$exeDeleteOvertime = $this->db->query("DELETE 
										FROM overtime
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will get the absences
	function exetGetAbsences($payid) {
		if($this->uri->segment(5) != '') {
			$and = " AND b.user_id = ".$this->db->escape($this->uri->segment(5))." ";
		} else {
			if($_SESSION['userLevel'] != 1 ) {
				$and = " AND b.user_id = ".$this->db->escape($_SESSION['userId'])." ";
			} else {
				$and = "";	
			}
		}
		$exetGetAbsences = $this->db->query("SELECT *
										FROM absences a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										WHERE a.payperiod = ".$this->db->escape($payid)."
										$and ");

		if($exetGetAbsences->num_rows() > 0) {
			return $exetGetAbsences->result_array();
		} else {
			return false;
		}	
	}

	#this will get the employees overtime to edit
	function exetGetAbsencesToEdit($payid,$userid) {
		$exetGetAbsencesToEdit = $this->db->query("SELECT *
										FROM absences a
										LEFT JOIN employees b
										ON a.user_id = b.user_id  
										WHERE a.payperiod = ".$this->db->escape($payid)."
										AND b.user_id 	= ".$this->db->escape($userid)." ");

		if($exetGetAbsencesToEdit->num_rows() > 0) {
			return $exetGetAbsencesToEdit->result_array();
		} else {
			return false;
		}	
	}

	#this will add employees absences
	function exeAddEmpAbsences() {
		$exetGetOvertime = $this->db->query("SELECT *
										FROM absences
										WHERE payperiod = '". $this->uri->segment(3)."
										AND user_id 	= ".$this->db->escape($_POST['userid'])." ");

		if($exetGetOvertime->num_rows() > 0) {
			return false;
		} else {
			$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($_POST['userid'])." ");
										
			$check = $checkemp->result_array();
			$salary = $check[0]['salary'];
			
			// 22 working days in a month
			$rate_per_day = $salary / 22;
			
			// rate per hour
			//$rate_per_hour = $rate_per_day / 8;
			
			$absent_rate = $rate_per_day * $_POST['absent'];
			
			$exeAddEmpAbsences = $this->db->query("INSERT INTO absences
											SET user_id 	= ".$this->db->escape($_POST['userid']).",
												payperiod 	= '". $this->uri->segment(3)."',
												absent 		= ".$this->db->escape($_POST['absent']).",
												rate 		= ".$this->db->escape($absent_rate).",
												status		= ".$this->db->escape($_POST['status'])." ");

			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;
		}
	}

	#this will update employees absneces
	function exeUpdateEmpAbsences($payperiod,$empid) {
		$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($_POST['userid'])." ");
										
		$check = $checkemp->result_array();
		$salary = $check[0]['salary'];
		
		// 22 working days in a month
		$rate_per_day = $salary / 22;
		
		// rate per hour
		//$rate_per_hour = $rate_per_day / 8;
		
		$absent_rate = $rate_per_day * $_POST['absent'];
			
		$exeUpdateEmpAbsences = $this->db->query("UPDATE absences
										SET absent 		= ".$this->db->escape($_POST['absent']).",
											rate 		= ".$this->db->escape($absent_rate).",
											status		= ".$this->db->escape($_POST['status'])."
										WHERE payperiod = ".$this->db->escape($payperiod)." 
										AND user_id 	= ".$this->db->escape($empid)."  ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}

	#this will delete the employees absences
	function exeDeleteAbsences($id) {
		$exeDeleteAbsences = $this->db->query("DELETE 
										FROM absences
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	function getContributions($userid) {
		$getContributions = $this->db->query("SELECT *
										FROM emp_contributions
										WHERE user_id = ".$this->db->escape($userid)."
										AND status = 1 ");

		if($getContributions->num_rows() > 0) {
			return $getContributions->result_array();
		} else {
			return false;
		}	
	}

	#this will get report
	function exeGetreport($payid) {
		if($this->uri->segment(5) != '') {
			$and = " AND b.user_id = ".$this->db->escape($this->uri->segment(5))." ";
		} else {
			if($_SESSION['userLevel'] != 1 ) {
				$and = " AND b.user_id = ".$this->db->escape($_SESSION['userId'])." ";
			} else {
				$and = "";	
			}
		}
		$exeGetreport = $this->db->query("SELECT *
										FROM report a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										LEFT JOIN employee_details c
										ON c.user_id = b.user_id
										LEFT JOIN payperiod d
										ON d.id = a.payperiod
										WHERE a.payperiod = ".$this->db->escape($payid)."
										$and ");

		if($exeGetreport->num_rows() > 0) {
			return $exeGetreport->result_array();
		} else {
			return false;
		}		
	}

	#this will get payslip
	function exeGetPayslip($payid) {
		if($this->uri->segment(5) != '') {
			$and = " AND b.user_id = ".$this->db->escape($this->uri->segment(5))." ";
		} else {
			if($_SESSION['userLevel'] != 1 ) {
				$and = " AND b.user_id = ".$this->db->escape($_SESSION['userId'])." ";
			} else {
				$and = "";	
			}
		}
		$exeGetPayslip = $this->db->query("SELECT *
										FROM payslip a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										LEFT JOIN employee_details c
										ON c.user_id = b.user_id
										LEFT JOIN payperiod d
										ON d.id = a.payperiod
										LEFT JOIN overtime e
										ON e.user_id = b.user_id
										LEFT JOIN absences f
										ON f.user_id = b.user_id
										WHERE a.payperiod = ".$this->db->escape($payid)."
										$and ");

		if($exeGetPayslip->num_rows() > 0) {
			return $exeGetPayslip->result_array();
		} else {
			return false;
		}		
	}
	

	#this will get the tax to be applied
	function exeGetBirTax() {
		$exeGetBirTax = $this->db->query("SELECT *
										FROM semi_birtable ");	

		if($exeGetBirTax->num_rows() > 0) {
			return $exeGetBirTax->result_array();
		} else {
			return false;
		}	
	}
	#this will save the pay slip
		function exeAddPaySlip() {
		$exeAddPaySlip = $this->db->query("INSERT INTO payslip
										SET user_id 		= ".$this->db->escape($_POST['userid']).",
											payperiod 		= ".$this->db->escape($this->uri->segment(3)).",
											sss 			= ".$this->db->escape($_POST['sss2']).",
											philhealth 		= ".$this->db->escape($_POST['philhealth2']).",
											pagibig 		= ".$this->db->escape($_POST['pagibig2']).",
											monthend 		= ".$this->db->escape($_POST['monthend2']).",
											overtime 		= ".$this->db->escape($_POST['otrate2']).",
											absences 		= ".$this->db->escape($_POST['abrate2']).",
											witholdingtax 	= ".$this->db->escape($_POST['withholdingtax2']).",
											netpay 			= ".$this->db->escape($_POST['netpay2'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}
	
	#this will delete the employees payslip
	function exeDeletePayslip($id) {
		$exeDeletePayslip = $this->db->query("DELETE 
										FROM payslip
										WHERE payperiod = '". $this->uri->segment(3)."
										AND user_id 	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}
	#this will save the pay slip
	function exeAddreport() {
		$exeAddreport = $this->db->query("INSERT INTO report
										SET user_id 		= ".$this->db->escape($_POST['userid']).",
											payperiod 		= ".$this->db->escape($this->uri->segment(3)).",
											sss 			= ".$this->db->escape($_POST['sss2']).",
											philhealth 		= ".$this->db->escape($_POST['philhealth2']).",
											pagibig 		= ".$this->db->escape($_POST['pagibig2']).",
											monthend 		= ".$this->db->escape($_POST['monthend2']).",
											overtime 		= ".$this->db->escape($_POST['otrate2']).",
											absences 		= ".$this->db->escape($_POST['abrate2']).",
											witholdingtax 	= ".$this->db->escape($_POST['withholdingtax2']).",
											grosspay 	= ".$this->db->escape($_POST['grosspay2']).",
											netpay 			= ".$this->db->escape($_POST['netpay2'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}
	
	#this will delete the employees report
	function exeDeletereport($id) {
		$exeDeletereport = $this->db->query("DELETE 
										FROM report
										WHERE payperiod = '". $this->uri->segment(3)."
										AND user_id 	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}
	
	#this will get the year period
	function exeGetYearPeriod() {
		$exeGetYearPeriod = $this->db->query("SELECT *
										FROM yearperiod
										ORDER BY id ASC");
										
		if($exeGetYearPeriod->num_rows() > 0) {
			return $exeGetYearPeriod->result_array();
		} else {
			return false;
		}
	}
	
	#this will get the 13th month
	function exetGet13Month($payid) {
		if($this->uri->segment(5) != '') {
			$and = " AND b.user_id = ".$this->db->escape($this->uri->segment(5))." ";
		} else {
			$and = "";
		}
		$exetGet13Month = $this->db->query("SELECT *
										FROM 13month a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										WHERE a.yearperiod = ".$this->db->escape($payid)."
										$and ");

		if($exetGet13Month->num_rows() > 0) {
			return $exetGet13Month->result_array();
		} else {
			return false;
		}	
	}
	
	#this will add employees 13th month
	function exeAddEmp13Month() {
		$exetGet13Month = $this->db->query("SELECT *
										FROM 13month
										WHERE yearperiod = '". $this->uri->segment(3)."
										AND user_id 	= ".$this->db->escape($_POST['userid'])." ");

		if($exetGet13Month->num_rows() > 0) {
			return false;
		} else {
			$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($_POST['userid'])." ");
										
			$check = $checkemp->result_array();
			$salary = $check[0]['salary'];
			
			$bonus = ($_POST['workedmonths'] * $salary)/12;
			if($bonus > 30000) {
				$temp = $bonus - 30000;
				$bonus_taxed = $temp - ($temp * 0.32);
				$totabonus = $bonus_taxed + $bonus;
			} else {
				$totabonus = $bonus;	
			}
			
			$exeAddEmp13Month = $this->db->query("INSERT INTO 13month
											SET user_id 	= ".$this->db->escape($_POST['userid']).",
												yearperiod 	= '". $this->uri->segment(3)."',
												no_of_months = ".$this->db->escape($_POST['workedmonths']).",
												amount 		= ".$this->db->escape($totabonus).",
												status		= ".$this->db->escape($_POST['status'])." ");

			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;
		}
	}
	
	#this will update employees 13th month
	function exeUpdateEmp13Month($yearperiod,$empid) {
		$checkemp = $this->db->query("SELECT * 
										FROM employee_details
										WHERE user_id 	= ".$this->db->escape($_POST['userid'])." ");
										
		$check = $checkemp->result_array();
		$salary = $check[0]['salary'];
		
		$bonus = ($_POST['workedmonths'] * $salary)/12;
		if($bonus > 30000) {
			$bonus_taxed = ($bonus - 30000) * 0.32;
			$totabonus = $bonus_taxed + $bonus;
		} else {
			$totabonus = $bonus;	
		}
			
		$exeUpdateEmp13Month = $this->db->query("UPDATE 13month
										SET user_id 	= ".$this->db->escape($_POST['userid']).",
												yearperiod 	= '". $this->uri->segment(3)."',
												no_of_months = ".$this->db->escape($_POST['workedmonths']).",
												amount 		= ".$this->db->escape($totabonus).",
												status		= ".$this->db->escape($_POST['status'])."
										WHERE yearperiod = ".$this->db->escape($yearperiod)." 
										AND user_id 	= ".$this->db->escape($empid)."  ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;
	}
	
	#this will get the employees 13th month to edit
	function exetGet13MonthToEdit($yearid,$userid) {
		$exetGet13MonthToEdit = $this->db->query("SELECT *
										FROM 13month a
										LEFT JOIN employees b
										ON a.user_id = b.user_id  
										WHERE a.yearperiod = ".$this->db->escape($yearid)."
										AND b.user_id 	= ".$this->db->escape($userid)." ");

		if($exetGet13MonthToEdit->num_rows() > 0) {
			return $exetGet13MonthToEdit->result_array();
		} else {
			return false;
		}	
	}
	
	#this will delete the employees 13th month
	function exeDelete13thMonth($id) {
		$exeDelete13thMonth = $this->db->query("DELETE 
										FROM 13month
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will add new record on pay period
	function exeAddNewYearperiod() {
		$exeCheckYear = $this->db->query("SELECT *
										FROM yearperiod
										WHERE title = ".$this->db->escape($_POST['myear'])." ");

		if($exeCheckYear->num_rows() > 0) {
			return false;
		} else {
			$exeAddNewYearperiod = $this->db->query("INSERT INTO yearperiod
										SET	title		= ".$this->db->escape($_POST['myear']).",	 
											status		= ".$this->db->escape($_POST['status'])." ");
	
			$rsQuery['affRows'] = $this->db->affected_rows();
			return $rsQuery;	
		}
	}

	function exeGetYearperiodToEdit($id) {
		$exeGetYearperiodToEdit = $this->db->query("SELECT *
										FROM yearperiod										
										WHERE id  = ". $id ."  ");
										
		if($exeGetYearperiodToEdit->num_rows() > 0) {
			return $exeGetYearperiodToEdit->result_array();
		} else {
			return false;
		}
	}

	#this will update record on pay period
	function exeUpdateYearperiod($id) {
		$exeUpdateYearperiod = $this->db->query("UPDATE yearperiod
									SET	title		= ".$this->db->escape($_POST['myear']).",
										status		= ".$this->db->escape($_POST['status'])."
									WHERE id 		= ".$this->db->escape($id)." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will delete the pay period record
	function exeDeleteYearperiod($id) {
		$exeDeleteYearperiod = $this->db->query("DELETE 
										FROM yearperiod
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}
	
	#this will add new record on pay period
	function exeAddTimelogs() {
		if(($handle = fopen("timereport/timelogs.csv","r")) !== false){
			while(($data = fgetcsv($handle,8000,",")) !== false){	
				$exeAddLogs = $this->db->query("INSERT INTO timelogs
											SET	emp_id		= ".$this->db->escape($data[0]).",	
												timein		= ".$this->db->escape($data[1]).",	
												timeout		= ".$this->db->escape($data[2]).",
												created_date = ".$this->db->escape($data[3])." ");
					
				
			}
		}
	
		fclose($handle);
	}



	function exeGetPhilhealth() {
		$exeGetPhilhealth = $this->db->query("SELECT *
										FROM philhealth_table");
										
		if($exeGetPhilhealth->num_rows() > 0) {
			return $exeGetPhilhealth->result_array();
		} else {
			return false;
		}
	}

	function exeGetPhilhealthToEdit($id) {
		$exeGetPhilhealthToEdit = $this->db->query("SELECT *
										FROM philhealth_table										
										WHERE id  = ". $id ."  ");
										
		if($exeGetPhilhealthToEdit->num_rows() > 0) {
			return $exeGetPhilhealthToEdit->result_array();
		} else {
			return false;
		}
	}


	#this will add new philhealth record
	function exeAddNewPhilhealth() {
		$exeAddNewPhilhealth = $this->db->query("INSERT INTO philhealth_table
									SET	min_salary	= ".$this->db->escape($_POST['minsal']).",		
										max_salary 	= ".$this->db->escape(ucwords($_POST['maxsal'])).",
										employer 	= ".$this->db->escape(ucwords($_POST['empshare'])).", 	
										employee 	= ".$this->db->escape(ucwords($_POST['emplshare'])).",
										total		= ".$this->db->escape($_POST['total']).",
										status		= ".$this->db->escape($_POST['status'])." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will update philhealth contribution
	function exeUpdatePhilhealthRecord($id) {
		$exeUpdatePhilhealthecord = $this->db->query("UPDATE philhealth_table
									SET	min_salary	= ".$this->db->escape($_POST['minsal']).",		
										max_salary 	= ".$this->db->escape($_POST['maxsal']).",
										employer 	= ".$this->db->escape($_POST['empshare']).", 	
										employee 	= ".$this->db->escape($_POST['emplshare']).",
										total		= ".$this->db->escape($_POST['total']).",
										status		= ".$this->db->escape($_POST['status'])."
									WHERE id 		= ".$this->db->escape($id)." ");

		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	#this will delete the philhealth record
	function exeDeletePhilhealthRecord($id) {
		$exeDeletePhilhealthRecord = $this->db->query("DELETE 
										FROM philhealth_table
										WHERE id	= ".$this->db->escape($id)." ");		
									
		$rsQuery['affRows'] = $this->db->affected_rows();
		return $rsQuery;	
	}

	##this will get the sss report
	function exetGetSSSReport($payid) {
		$exetGetSSSReport = $this->db->query("SELECT *
										FROM payslip a
										LEFT JOIN employees b
										ON a.user_id = b.user_id 
										LEFT JOIN payperiod c
										ON c.id = a.payperiod
										LEFT JOIN employee_details d
										ON d.user_id = a.user_id
										WHERE a.payperiod = ".$this->db->escape($payid)." ");

		if($exetGetSSSReport->num_rows() > 0) {
			return $exetGetSSSReport->result_array();
		} else {
			return false;
		}	
	}

	Public function getEvents()
	{
		
	$sql = "SELECT * FROM events WHERE events.date BETWEEN ? AND ? ORDER BY events.date ASC";
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



#add leave request
#add leave request
#add leave request

	  private function _get_datatables_query()
    {
  		
        $this->db->from($this->leave_table);


  
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
 
    function get_datatables()
    {
    	
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);   	
  		$this->db->where('user_id', $this->session->userdata('username')); 
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
        $this->db->where('id',$id);
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
        $this->db->where('id', $id);
        $this->db->delete($this->leave_table);
    }
 

#add overtime request
#add overtime request
#add overtime request



    	  private function ot_get_datatables_query()
    {
         
        $this->db->from($this->ot_table);

 
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
 
    function ot_get_datatables()
    {
        $this->ot_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
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
        $this->db->where('id',$id);
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
        $this->db->where('id', $id);
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
    
        $this->db->from('emp_workschedule');
        $this->db->join('employees','employees.user_id = emp_workschedule.user_id');
        $this->db->join('employee_details','employee_details.user_id = emp_workschedule.user_id');
        

	
   
       
    	
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
    	$this->db->where('employee_details.user_id !=', $this->session->userdata('username')); 
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
        $this->db->join('employees','employees.user_id = emp_workschedule.user_id');
        $this->db->join('employee_details','employee_details.user_id = emp_workschedule.user_id');
        $this->db->where('employee_details.user_id =', $id); 
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
        $this->db->where('id', $id);
        $this->db->delete($this->emp_table);
    }








//session

    public function takeUser($username, $password, $status, $level)

		{

		$this->db->select('*');

		$this->db->from('employees');

		$this->db->where('user_id', $username);

		$this->db->where('emp_pass', $password);

		$this->db->where('status', $status);

		$this->db->where('userlevel', $level);

		$query = $this->db->get();

		return $query->num_rows();

		}

		public function userData($username)

		{

		$this->db->select('emp_id');

		$this->db->select('user_id');

		$this->db->where('user_id', $username);

		$query = $this->db->get('employees');

		return $query->row();

		}
 
	
}

?>