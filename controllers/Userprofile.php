<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile extends MY_controller {

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
		if($this->session->userdata('LoginEmail')=='')
		{
			redirect(base_url().'login');
		} 
        // check if logged_in
    }
	 
	public function index()
	{
		$this->curlhandler();
		// echo "<pre>"; 
		// print_r($this->page_api);
		// exit;	
		// echo $this->session->userdata('refferalurl');
		// exit;
		$this->fileincluded('userprofile');
		$this->load->view('templates/layout',$this->data);
	}
	
	public function Updateuserinfo()
	{
		$this->page_api['curl_edit_user_profile']=$this->config->item('Userprofile_API')['curl_edit_user_profile'];
		$this->page_api=ReplaceRecursive($this->page_api,'userEmail',$_GET['uid']);
		$this->page_api=ReplaceRecursive($this->page_api,'name',$_GET['name']);
		$this->page_api=ReplaceRecursive($this->page_api,'mobile',$_GET['mobile']);
		$this->page_api=ReplaceRecursive($this->page_api,'houseNumber',$_GET['housenumber']);
		$this->page_api=ReplaceRecursive($this->page_api,'street',$_GET['street_loc']);
		$this->page_api=ReplaceRecursive($this->page_api,'pincode',$_GET['pincode']);
		$this->page_api=ReplaceRecursive($this->page_api,'city',$_GET['city']);
		$this->page_api=ReplaceRecursive($this->page_api,'state',$_GET['state']);
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		$output_data=json_decode($this->data['mcurldata']['curl_edit_user_profile']['response']);
		// echo "<pre>";
		// print_r($output_data);
		// exit;
		
		if($output_data->successful==TRUE)
		{
			$this->session->set_userdata('LoginUsername', $_GET['name']);
			$this->session->set_userdata('Mobile', $_GET['mobile']);
		}
		// print_r($this->data['mcurldata']);
		$output = array('ret_status' => $output_data->successful,'ret_url'=>$this->session->userdata('refferalurl'));
	
		echo json_encode($output);		
	}
	public function curlhandler()
	{
		$this->page_api=$this->config->item('Userprofile_API');
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		$this->page_api['curl_get_shopsitycash']=ReplaceRecursive($this->page_api['curl_get_shopsitycash'],'sufix_url','ShopSity.svc/GetUserTransactionHistory/'.$this->session->userdata('LoginUserid').'/1' );
		$this->page_api['curl_get_user_profile']=ReplaceRecursive($this->page_api['curl_get_user_profile'],'userEmail',$this->session->userdata('LoginEmail'));
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		//$this->session->set_userdata('refferalurl',$this->agent->referrer());
		
	}

}
