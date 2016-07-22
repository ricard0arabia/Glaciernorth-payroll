  	var $emplist_table = 'employee_details';
    var $emplist_column_order = array('emp_details_id','user_id','birthdate','gender','jobtitle','datehired','address','incase_emergency','emergency_no','cstatus','salary','department','contact_no','hdmf_no','tin_no','sss_no','philhealth_no','img_name','thumb_name','ext','upload_date',null); //set column field database for datatable orderable
    var $emplist_column_search = array('user_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $emplist_order = array('emp_details_id' => 'desc'); // default
	#build constructor

	      var $emp_table = 'emp_workschedule';
    var $emp_column_order = array('id','user_id','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thurs_start','thurs_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end',null); //set column field database for datatable orderable
    var $emp_column_search = array('user_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $emp_order = array('id' => 'desc'); // default
