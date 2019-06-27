<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitycash extends MY_controller {

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
		$this->load->library('user_agent');
        // check if logged_in
		if(!$this->session->userdata('LoginEmail'))
       {
			redirect('login');
		}
    }
	 
	public function index()
	{

		$this->curlhandler();
		$this->fileincluded('shopsitypage');
		$this->load->view('templates/layout',$this->data);
	}
	public function curlhandler()
	{
		$this->page_api=$this->config->item('Shopsitycash_API');
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		$this->page_api['curl_get_shopsitycash']=ReplaceRecursive($this->page_api['curl_get_shopsitycash'],'sufix_url','ShopSity.svc/GetUserTransactionHistory/'.$this->session->userdata('LoginUserid').'/1' );
			// echo "<pre>";
			// print_r($this->page_api['curl_get_shopsitycash']);
			// exit;
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		$this->session->set_userdata('refferalurl',$this->agent->referrer());
		
	}
	
	

}
