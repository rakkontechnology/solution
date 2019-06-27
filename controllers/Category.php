<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_controller {

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
		$this->fileincluded('category');
		// echo "------------";
		// print_r(get_cookie('shopsity_CityName'));
		// echo "++++++++";
		// exit;
		$this->load->view('templates/layout',$this->data);
		}
	
	public function curlhandler()
	{
		// echo $this->data['cityname'];
		$url=str_replace(base_url(),'',get_full_url());
		
		$this->page_api=$this->config->item('Category_API');
		$this->replace_api_parameter=$this->config->item('replace_api_parameter');
		$this->page_api=ReplacementParameter($this->page_api,$this->replace_api_parameter[$this->seg2name]);
		// $this->page_api=ReplaceLongiAndLatidute($this->data['cityname'],$this->page_api);
		// $this->page_api['curl_banner']=ReplaceRecursive($this->page_api['curl_banner'],'sufix_url','app/fetchBannersByCategory?category='.$this->seg2name);
		$this->page_api=ReplaceRecursive($this->page_api,'Url',$url.'/?offerid=31');
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		// echo "<pre>"; 
		// print_r($this->page_api);
		// exit;
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
	}
}
