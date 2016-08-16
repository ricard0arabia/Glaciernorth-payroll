<?php


class Calendar extends CI_Controller {

		function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('Contents');
    }


	/*Home page Calendar view  */
	Public function index()
	{
		$this->load->view('home');
	}

	/*Get all Events */

	Public function getEvents($id)
	{
		$result=$this->Contents->getEvents($id);
		echo json_encode($result);
	}
	/*Add new event */
	Public function addEvent()
	{
		$result=$this->Contents->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
		$result=$this->Contents->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->Contents->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{	

		$result=$this->Contents->dragUpdateEvent();
		echo $result;
	}



}
