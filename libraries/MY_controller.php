<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_controller extends CI_Controller {
   function __construct()
    {
		
		$this->data['retrieveconstant']=array();
        parent::__construct();
		
		$this->load->library('encrypt');
		$this->load->helper('array');		
		$this->load->helper('form');
		$this->load->helper('cookie');
	
 // $this->output->cache(1440);
 // $this->output->delete_all_cache();

	
		
		//**session add city code implement start here
		$this->city=$this->uri->segment(1);   
		$this->zonecity=ucwords(CityReplaceRevertCity($this->city));
		$this->city=Cityreplacecharacter($this->city);
		
		
		// echo "<pre>";
		// print_r($cookie);
		
	// echo $this->city;

	

		
		if(SearchLocationExist($this->zonecity,'Zone')==true)
		{	
	// echo "here";
		$cookie = array(
		'name'   => 'CityName',
		'value'  => strtolower($this->city),
		'expire' => 10*60*60*24,    //here are 30 define the day you can use 30*2,30*3
		'domain' => '',
		'path'   => '/',
		'prefix' => 'shopsity_',
		'secure' => FALSE
		);
		set_cookie($cookie);
		} elseif(get_cookie('shopsity_CityName')=='') {	
		// echo "+++++++++".$this->city;
		// echo "coming";
		// exit;
		$cookie = array(
		'name'   => 'CityName',
		'value'  => Cityreplacecharacter('south delhi'),
		'expire' => 10*60*60*24,
		'domain' => '',
		'path'   => '/',
		'prefix' => 'shopsity_',
		'secure' => FALSE
		);
		set_cookie($cookie);
		
		}
		// echo "------------";
		// print_r(get_cookie('shopsity_CityName'));
		// echo "++++++++";
		// exit;
        // do some stuff
		
		//**autoload model and library called here
		$this->load->model('CurlModel');
		//**autoload model and library called here
		// echo site_url();
			// exit;
		//auto redirect after check the location 
		if(base_url()==base_url(uri_string()))
		{
			
			redirect(site_url(get_cookie('shopsity_CityName')));
		}
		//auto redirect code will end here 
		
		$this->seg2name=$this->uri->segment(2);   
		$this->seg3name=$this->uri->segment(3);   
		$this->seg2name=strtolower($this->seg2name);
	
		foreach($this->config->item('common_page_constant') as $key=>$val)
		{
		$this->load->config(PAGE_CONSTANT_PATH.$val);
			
		$this->data['retrieveconstant']=array_merge($this->data['retrieveconstant'],$this->config->item($val) );
		}
		// echo $this->zonecity;
		// exit;
		if(SearchLocationExist($this->zonecity,'Zone')==true)
		{	
			$this->data['cityname']=CityReplaceRevertCity($this->city);
		} else
		{
			$this->data['cityname']=CityReplaceRevertCity(get_cookie('shopsity_CityName'));
		}
		
		$this->data['seg2name']=strtolower($this->seg2name);
		$this->data['all_location_exist']=GetAllLocation();
	    }
	
	/********File included function defined by shopsity********************************/
	public function fileincluded($controllername)
	{		
		//all page constant
		GetAllPageConstant($this->config->item($controllername)['page_constant_name']);
		// this is for sort an array page constant
		GetAllPageConstantSort($this->config->item($controllername)['page_constant_name']);
		
		$this->data['layout_file']=$this->config->item($controllername);
		
	}
	
	
		/********Pixel handaler********************************/
	public function pixeldatahandaler($actionType,$appViewName,$storeCode,$vendorCode)
	{	
	//This code for the pixel API
		$this->pixel_api=$this->config->item('Pixel_API');
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'actionType',$actionType);
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'appViewName',$appViewName);
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'storeCode',$storeCode);
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'userAgent',$_SERVER['HTTP_USER_AGENT']);
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'userId',$this->session->userdata('LoginUserid'));
		$this->pixel_api=ReplaceRecursive($this->pixel_api,'vendorCode',$vendorCode);
		$this->pixel_api=$this->CurlModel->callmulticurl($this->pixel_api);
		//This code End for the pixel API
	}
	
}