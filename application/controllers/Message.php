<?php



class Message extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','message');
	}

	public function index(){

		 if($this->session->userdata('isLogin') == FALSE)
        {

        redirect('logins/login_form');
        }
        else{
	
		
		$this->load->helper('url');	
        $this->load->view('header');
        $data['user'] = $this->session->userdata('username');
        $data['message'] = $this->db->select('*')->from('message')->where('recipient_id',$this->session->userdata('username'))->order_by('id','desc')->get();
        $this->load->view('pages/message',$data);
		$this->load->view('footer');
		}
	}

	public function detail(){

        $detail = $this->db->select('*')->from('message')->where('id',$this->input->post('id'))->get()->row();

        if($detail){

            $this->db->where('id',$this->input->post('id'))->update('message',array('read_status'=>1));

            $arr['name'] = $detail->name;
            $arr['email'] = $detail->email;
            $arr['subject'] = $detail->subject;
            $arr['message'] = $detail->message;
            $arr['created_at'] = $detail->created_at;
              $arr['recipient_id'] = $detail->recipient_id;
            $arr['update_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
            $arr['success'] = true;

        } else {

            $arr['success'] = false;
        }

        
        
        echo json_encode($arr);

    }
	 public function ajax_list()
    {
        $list = $this->message->emp_get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $message) {
            $no++;
            $row = array();
            $row[] = '<img height="60" width="60" src="'.base_url().'uploads/'.$message->thumb_name.$message->ext.'">';
     	  	$row[] = $message->user_id;
            $row[] = ucfirst($message->firstname).' '.ucfirst(substr($message->middlename,0,1)).'. '.ucfirst($message->lastname);
            $row[] = $message->position;
            $row[] = $message->department;
            $row[] = $message->contact_no;
            $row[] = $message->address;
           
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary"  title="Edit" onclick="send_message('."'".$message->user_id."'".')">Send Message</a>';

                  $data[] = $row;
     
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->message->emp_count_all(),
                        "recordsFiltered" => $this->message->emp_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

       public function get_id($id)
    {
        $data = $this->message->emp_get_by_id($id);
        echo json_encode($data);
    }


    public function send_message()
    {
        $this->_validate();
        
        $data = array(
        		'name' => $this->input->post('name'),
        		'email' => $this->input->post('email'),
                'subject' => $this->input->post('subject'),
        		'message' => $this->input->post('message'),
                'recipient_id' =>  $this->input->post('recipient_id'),
                          
          );
        $insert = $this->message->message_save($data);
        $detail = $this->db->select('*')->from('message')->where('recipient_id',$this->input->post('recipient_id'))->get()->row();
        echo json_encode(array("status" => TRUE,
            "name" => $detail->name,
            "email" => $detail->email,
            "subject" => $detail->subject,
            "created_at" => $detail->created_at,
            "recipient_id" => $detail->recipient_id,
             "read_status" => $detail->read_status,
            "id" => $detail->id,
            "new_count_message" => $this->db->where('read_status',0)->count_all_results('message'),
            "notif" => '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>'


            ));

    }

       private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = array();
        $data['name'] = array();
        $data['email'] = array();
        $data['subject'] = array();
        $data['created_at'] = array();
        $data['recipient_id'] = array();
        $data['id'] = array();
        $data['new_count_message'] = array();
        $data['notif'] = array();

        if($this->input->post('recipient_id') == '')
        {
            $data['inputerror'][] = 'recipient_id';
            $data['error_string'][] = 'Recipient Id is required';
            $data['status'] = FALSE;
        }
 
		if($this->input->post('subject') == '')
        {
            $data['inputerror'][] = 'subject';
            $data['error_string'][] = 'Subject is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('message') == '')
        {
            $data['inputerror'][] = 'message';
            $data['error_string'][] = 'Message is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

         if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }

          
    }


}