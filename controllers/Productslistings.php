<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productslistings extends MY_controller {

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
	
		$this->curlhandler();
		// echo "<pre>";
		// print_r($this->data['mcurldata']);
		// exit;
		$this->fileincluded('productslisting');
		$this->load->view('templates/layout',$this->data);
	}

	
	
	/****************************get products data************************************/
	public function getprductdata()
	{
		
		$url=str_replace(base_url(),'',get_full_url());
		$pagesize= DEFINE_LISTING_PAGE_SIZE;
		$post_data=remove_empty_array_value($_POST);
		unset($post_data['city']);
		unset($post_data['pagenumber']);
		unset($post_data['startIn']);
		unset($post_data['orgurl']);
		
		
		// unset($post_data['q']);
		
		$this->page_api['curl_get_products']=$this->config->item('Productslisting_API')['curl_get_products'];
		$this->page_api=ReplaceRecursive($this->page_api,'StartIndex',$_POST['startIn']); 
		$this->page_api=ReplaceRecursive($this->page_api,'Url',$_POST['orgurl']);
	// echo "<pre>";
	// print_r($this->page_api);
	// exit;
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		$this->load->view('templates/ajax_productslisting',$this->data);
	
	}	
	
	public function curlhandler()
	{
	$url=str_replace(base_url(),'',get_full_url());
	if(strpos($url, '&startIn')==true)
	{
	$filterurl=substr($url, 0, strpos($url, '&startIn'));
	} else
	{
		$filterurl=$url;
	}
	
	// echo $this->data['seg2name'];
	// exit;
	// if(product)

	
	$this->page_api=$this->config->item('Productslisting_API');
	$this->page_api=ReplaceRecursive($this->page_api,'Url',$url);
	$this->page_api['curl_get_products_filter']=ReplaceRecursive($this->page_api['curl_get_products_filter'],'Url',$filterurl);
	
	$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
	if(isset($_GET['pagenumber']))
	{ $this->data['pagenumber']=$_GET['pagenumber'];	} else {	$this->data['pagenumber']=1;  }

	if(isset($_GET['startIn']))
	{  $this->page_api=ReplaceRecursive($this->page_api,'StartIndex',$_GET['startIn']);  }
$this->page_api['curl_get_products_filter']=ReplaceRecursive($this->page_api['curl_get_products_filter'],'StartIndex',0);
	// echo "<pre>";
	// print_r( $this->page_api);
	// exit;
	
	$this->data['cityname']=str_replace(' ','_',$this->data['cityname']);
	$this->data['sort_filter_array']=$this->config->item('sorting_filter');
	$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
	
	}
	
	//for the filtering department
	public function Filter()
	{
		$this->data['referurl']=str_replace(base_url(),'',$this->agent->referrer());
		
		parse_str(parse_url($this->data['referurl'], PHP_URL_QUERY), $queries);
		// echo "<pre>";
		// print_r($this->data['referurl']);
		// exit;
	
		$whitelist = array('size','colour','price','orderby');
		$filtered = array_intersect_key( $queries, array_flip( $whitelist ) );
		$this->page_api['curl_get_products']=$this->config->item('Productslisting_API')['curl_get_products'];
		
		$this->page_api=ReplaceRecursive($this->page_api,'StartIndex',0); 
		$this->page_api=ReplaceRecursive($this->page_api,'Url',$this->data['referurl']);
		/*$this->tot_key=implode(",",array_keys($filtered));
		$this->tot_val=implode(',',$filtered);
		$this->page_api=ReplaceRecursive($this->page_api,'SearchParamCommaSeperate',$this->tot_key);
		$this->page_api=ReplaceRecursive($this->page_api,'PageSize',DEFINE_LISTING_PAGE_SIZE);
		$this->page_api=ReplaceRecursive($this->page_api,'SearchValueCommaSeperate',$this->tot_val);
		if(in_array('IsOffer',$queries)==true)
		{
		$this->page_api=ReplaceRecursive($this->page_api,'IsOffer','true'); 
		}
		$this->page_api=ReplaceLongiAndLatidute($this->data['cityname'],$this->page_api);*/
		
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		
		// echo "<pre>";
		// print_R($this->data['mcurldata']);
		// exit;
		/*$this->data['minpricesend']=isset($queries['minprice']) ? $queries['minprice'] : '';
		$this->data['maxpricesend']=isset($queries['maxprice']) ? $queries['maxprice'] : '';*/
		$this->fileincluded('productsfilter');
		$this->load->view('templates/layout',$this->data);
		
	}
	
}
