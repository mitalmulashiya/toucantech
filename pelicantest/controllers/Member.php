<?php 
	
	// Main controller
	// Uses to perform view/add members to school
	
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller 
{
	// Initialize construction and then codeigniter base class. 
	function __construct()
	{
		parent::__construct();
		$this->load->model('members'); // Load the meber model
	}
	
	public function index()
	{
		// call the display function.
		$this->display();
	}
	
	public function display()
	{
		$this->page['title']=$this->lang->line('view'); // set the page title
		$school_id = $this->input->post('school_id');
	
		if(!empty($school_id))
			$this->data['school_members']=$this->members->by_school($school_id);
		
		$this->data['school_id'] = $school_id;
		$this->data['schools'] = $this->members->get_schools();
		$this->render(array('members'));
	}
	
	public function checkuser($email)
	{
		//check for the duplicate email
		$member_exists=$this->members->get_record('email',$email);
		if(!$member_exists)
			return true;
			$this->form_validation->set_message('checkuser',$this->lang->line('email_exists'));	 //"Email already exists";
		return false;
		
	}
	
	public function checkschool($school)
	{
		// check if school is selected
		if(is_array($school) && !empty($school))
		{	
			$this->form_validation->set_message('checkuser',$this->lang->line('email_exists'));	 //"Email already exists";
			return false;
		}
		return true;
	}
	
	// function to add new member to school
	public function add()
	{
		$this->page['title']=$this->lang->line('add');
		
		$mname = $this->input->post('mname'); // collect form inputs
		$memail = $this->input->post('memail');
		$mschool = $this->input->post('mschool');
		if(!empty($memail))
		{
			//validation code start
			$this->load->library('form_validation');
			$this->form_validation->set_rules('mname', $this->lang->line('member'), 'trim|required');
			$this->form_validation->set_rules('memail',  $this->lang->line('email'), 'trim|required|valid_email|callback_checkuser');
			$this->form_validation->set_rules('mschool',  $this->lang->line('school'), 'callback_checkschool');
			
			if($this->form_validation->run() != FALSE)
			{
				// add record entry to database
				$member_data=array("name"=>$mname,"email"=>$memail,"add_date"=>time());
				$res=$this->members->add_member($member_data,$mschool);
				if($res)
					redirect('member/added');
				else
					$msgerr=$this->lang->line('db_error');//"Error to add member. Try again";
		
			}
		
		}
		
		$this->data['schools'] = $this->members->get_schools();
		$this->render(array('add_members'));
		
	}
	
	public function added()
	{
		$this->page['title']=$this->lang->line('add');
		
		$this->data['success']=$this->lang->line('member_added');
		$this->data['schools'] = $this->members->get_schools();
		$this->render(array('add_members'));
	}
}	

