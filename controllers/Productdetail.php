<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productdetail extends MY_controller {

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
		// header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		// header("Pragma: no-cache"); // HTTP 1.0.
		// header("Expires: 0"); // Proxies.
        // check if logged_in
		$this->load->library('user_agent');
    }
	 
	 
	public function index()
	{
		$this->curlhandler('Productdetail_API');
		
		$this->fileincluded('productsdetails');
		$this->load->view('templates/layout',$this->data);
	}
	
	public function Checkout()
	{
		$this->session->set_userdata('refferalurl',$this->agent->referrer());
		$this->curlhandler('Checkoutprocess_API');
		$this->data['referurl']	=$this->agent->referrer();
		$latang=GetLatLong($this->data['cityname']);
		$this->data['latitude']	=$latang[0];
		$this->data['longitude']=$latang[1];
		$this->fileincluded('checkoutprocess');
		// echo $this->session->userdata('refferalurl');
		// exit;
		// echo "<pre>"; 
		// print_r($this->data);
		// exit;	
		$this->load->view('templates/layout',$this->data);
	}
	
	
	/****************************get products data************************************/
	/*public function Getlogindetail()
	{
		$this->page_api['curl_create_order']=$this->config->item('Productdetail_API')['curl_create_order'];
		$this->page_api=ReplaceRecursive($this->page_api,'UserId',$this->session->userdata('LoginUserid'));
		$this->page_api=ReplaceRecursive($this->page_api,'OrderType',$_GET['ordertype']);
		
		$this->page_api=ReplaceRecursive($this->page_api,'Size',$_GET['size']);
		$this->page_api=ReplaceRecursive($this->page_api,'ProductId',$_GET['productid']);

		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		// echo "<pre>";
		// print_r($this->data['mcurldata'] );
		// exit;
		//This code for the pixel API
		$this->pixeldatahandaler('ORDER','ORDER',$_GET['storecode'],$_GET['vendorcode']);
		
		//This code End for the pixel API
		
		$output = array('login_status' => true,'mobile_status'=>true,'size'=>$_GET['size'],'response'=>json_decode($this->data['mcurldata']['curl_create_order']['response']));	
		echo json_encode($output);		
	}
	*/
	public function curlhandler($apiname)
	{
		$this->page_api=$this->config->item($apiname);
		if($apiname=='Checkoutprocess_API')
		{
			$url=str_replace(base_url(),'',$this->agent->referrer());
		} else
		{
		$url=str_replace(base_url(),'',current_url());
		}
		$this->page_api=ReplaceRecursive($this->page_api,'Url',$url);
		if($apiname=='Productdetail_API')
		{
		$this->page_api['curl_deal_banner']=ReplaceRecursive($this->page_api['curl_deal_banner'],'Url',$url.'/?offerid=31');
		}
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		$this->page_api['curl_get_user_profile']=ReplaceRecursive($this->page_api['curl_get_user_profile'],'userEmail',$this->session->userdata('LoginEmail'));
		
		
		
		
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		if($apiname=='Productdetail_API')
		{
		$detailresponse_data=json_decode($this->data['mcurldata']['curl_get_productsdetail']['response']);
		$this->pixeldatahandaler('PRODUCT_VISIT','PRODUCT_DETAIL',$detailresponse_data->Data->Product->StoreId,$detailresponse_data->Data->Product->VendorId);
		} 
	
		// Pixel_API
		// echo "<pre>";
		// print_R($this->data['mcurldata']['curl_get_productsdetail']);
		// exit;
	}
	
	public function Map()
	{
		
		//$this->curlhandler('mappage_API');
		$this->fileincluded('mappage');
		$this->pixeldatahandaler('MAP','MAP_DETAIL',$_POST['storeid'],$_POST['vendroid']);
		$this->load->view('uidesign/mappage/simplemap',$this->data);
		// echo "<pre>"; 
		// print_r($this->data);
		// exit;		
		
	}
	
	
	public function Pixelhandaler()
	{
		//This code for the pixel API
		$this->pixeldatahandaler('ORDER','ORDER',$_GET['storeid'],$_GET['vendroid']);
	}

	
}
