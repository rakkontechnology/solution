<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_controller {

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
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		header("Pragma: no-cache"); // HTTP 1.0.
		header("Expires: 0"); // Proxies.
        // check if logged_in
		if(!$this->session->userdata('LoginEmail'))
       {
			redirect('login');
		}
    }
	 
	 
	public function index()
	{
		$this->curlhandler();
		// echo "<pre>"; 
		// print_r($this->data['mcurldata']);
		// exit;
		$this->fileincluded('order');
		$this->load->view('templates/layout',$this->data);
	}
	
	
	public function Cancelorder()
	{
		$this->data['reffer_url']=$this->agent->referrer();
		$this->fileincluded('cancelorderpopup');
		$this->load->view('uidesign/'.$this->data['layout_file']['cancelorderreason']['ui'],$this->data);
		// $this->load->view('templates/layout',$this->data);
		
	}
	
	public function curlhandler()
	{
	$this->page_api=$this->config->item('Orders_API');
	$this->page_api['curl_get_orders']=ReplaceRecursive($this->page_api['curl_get_orders'],'sufix_url','shopsity.svc/GetUserOrders/'.$this->session->userdata('LoginUserid') );
	$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
	
	$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
	}
	
}
