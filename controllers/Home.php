<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_controller {

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
		
        // check if logged_in
		
    }
	public function index()
	{
		$this->curlhandler();
		// echo "<pre>"; 
		// print_r($this->data['mcurldata']);
		// exit;
		$this->fileincluded('home');
		$this->load->view('templates/layout',$this->data);
	}
	
	public function curlhandler()
	{
		$url=str_replace(base_url(),'',get_full_url());
		$this->page_api=$this->config->item('Home_API');
		$this->page_api=ReplaceRecursive($this->page_api,'Url',$url.'/?offerid=31');
		// echo "<pre>";
		// print_r($this->page_api);
	// exit;
		
		//$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
	}
	
	

}
