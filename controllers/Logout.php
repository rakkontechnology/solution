<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
    {
        parent::__construct();
		$this->load->model('LoginModel');
		$this->load->library('user_agent');
		
        // check if logged_in
    }
	 
	 
	public function index()
	{	
	$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
		$this->session->unset_userdata('token');
	
		
		// $this->session->unset_userdata('LoginEmail');
		// $this->session->unset_userdata('LoginUsername');
		// $this->session->unset_userdata('Mobile');
		
    $this->session->sess_destroy();
   redirect($this->agent->referrer());
	}
}
