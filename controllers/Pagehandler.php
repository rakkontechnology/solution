<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagehandler extends MY_controller {

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
    }
	 
	public function index()
	{

		$this->curlhandler('Cmspage_API');
		$pagename=$this->uri->segment(1);   
	
		$this->data['pagedata']=$pagename;
		
		
		
		
		$this->fileincluded('cmspage');

		$this->load->view('templates/layout',$this->data);
	}
	
	public function Contactus()
	{
		
		$this->curlhandler('Conactus_API');
		
		$this->fileincluded('contactus');
		$this->load->view('templates/layout',$this->data);
	}
	
	public function Pushnotification()
	{
	
		$this->curlhandler('Pushnotify_API');
		
		$this->fileincluded('pushnotify');
		$this->load->view('templates/layout',$this->data);
	}
	
	public function curlhandler($pagename)
	{
		$this->page_api=$this->config->item($pagename);
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		if($pagename=='Pushnotify_API')
		{
		$this->page_api['pushnotify_curl']=ReplaceRecursive($this->page_api['pushnotify_curl'],'sufix_url','ShopSity.svc/GetPushNotificationsCampaign/xxx/1');
		}
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		$this->session->set_userdata('refferalurl',$this->agent->referrer());
		
	}

}
