<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	protected $data = Array(), $page = Array(), $today;
	
    function __construct($check_login=true,$check_admin=false)
	{
		parent::__construct();
		
		$this->output->enable_profiler(); 
		$this->lang->load('common');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->driver('session');
		
		$this->today = date('Y-m-d H:i:s');
		$this->page['extra_codes'] = array();
		$this->page['controller'] = strtolower($this->router->fetch_class());
		
		$session_data = $this->session->userdata('sessiondata');
	}
	
    protected function render($view_file) 
	{
		$this->load->view('header',$this->page);
		$this->load->view('menu',$this->page);
		
		foreach($view_file as $view)
        	$this->load->view($view,$this->data); 

		$this->load->view('footer');
	}
	
	protected function render_json($view_file,$ajax_data) 
	{
		$ajax_data['output'] = json_encode($ajax_data);
		$this->load->view($view_file,$ajax_data); 

	}
	
	protected function send_email($to_email,$template,$email_subject,$template_data)
	{
		$from_email = $this->config->item('FROM_EMAIL');
		$from_name = $this->config->item('FROM_NAME');
		$email_template_dir = $this->config->item('EMAIL_TEMPLATE_DIR');
		$email_txtfile_prefix = $this->config->item('EMAIL_TXTFILE_PREFIX');
		
		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		
		$this->email->subject($email_subject);
		
		$email_body = $this->load->view($email_template_dir.$template,$template_data,TRUE);
		$this->email->message($email_body);
		
		$email_body = $this->load->view($email_template_dir.'text_'.$template,$data,TRUE);
		$this->email->set_alt_message();
		
		$this->email->set_newline("\r\n");
		$this->email->send();
	}
	
}