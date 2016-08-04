<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Contents','leave');
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
        $data['message'] = $this->db->select('*')->from('message')->order_by('id','desc')->get();
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
			$arr['update_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
			$arr['success'] = true;

		} else {

			$arr['success'] = false;
		}

		
		
		echo json_encode($arr);

	}

}