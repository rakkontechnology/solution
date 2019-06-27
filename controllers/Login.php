<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_controller {

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
	
		if($this->session->userdata('LoginEmail'))
       {
			redirect($this->agent->referrer());
		}
        // check if logged_in
    }
	 
	 
	public function index()
	{	
		
		
		$this->session->set_userdata('refferalurl',$this->agent->referrer());
		
		$this->curlhandler();
		// echo "<pre>"; 
		// print_r($this->data['mcurldata']);
		// exit;	
		$this->fileincluded('login');
		$this->load->view('templates/layout',$this->data);
	}
	
	//THIS FUNCTION IS USED TO BE THE FACEBOOK PROGRAMME
public function Facebook()
{
			$this->fileincluded('login');
			$this->page_api['curl_social_api']=$this->config->item('Login_API')['curl_social_api'];
			include APPPATH . 'third_party/facebook/facebook.php';
			$facebook = new Facebook(array('appId' => APP_ID,'secret' => APP_SECRET,));
			$user = $facebook->getUser();
			$access_token=$facebook->getAccessToken();
			if ($user) {  
			try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
				} 
			catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
			}
		if (!empty($user_profile )) {
		$this->page_api=ReplaceRecursive($this->page_api,'un',urlencode($user_profile['email']));
		$this->page_api=ReplaceRecursive($this->page_api,'pwd',urlencode($access_token));
		$this->page_api=ReplaceRecursive($this->page_api,'snt',urlencode('FB'));
		
		$this->data['mcurldata']=$this->CurlModel->callmulticurl($this->page_api);
		$output_data=json_decode($this->data['mcurldata']['curl_social_api']['response']);
		// echo "<pre>"; 
		// print_r($output_data);
		// exit;	
		//if($output_data->msg->code==2){			
			
		$this->session->set_userdata('LoginUsername', $output_data->rs->name);
		$this->session->set_userdata('LoginEmail', $output_data->rs->email);
		$this->session->set_userdata('LoginUserid', $output_data->rs->id);
		$this->session->set_userdata('Mobile', $output_data->rs->mobile);
	
		//$this->LoginModel->insert_facebook_entry($user_profile);
		if($this->session->userdata('LoginEmail'))
		{
		redirect($this->session->userdata('refferalurl'));
		
		}
       
        // } else if($output_data->msg->code== 1){
		 // $this->data['facebookoutput']=$output_data;

		// $this->load->view('uidesign/'.$this->data['layout_file']['popup']['ui'],$this->data);
		
        // }
		
	
	}
	else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
			}
	} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array('scope' => 'email'));
	redirect($login_url);
	}
	
}				
	//THIS FUNCTION IS USED TO BE THE FACEBOOK PROGRAMME
public function Gmail()
{
	$this->fileincluded('login');
	$this->page_api['curl_social_api']=$this->config->item('Login_API')['curl_social_api'];
	
	
	include APPPATH . 'third_party/gmail/src/apiClient.php';
	include APPPATH . 'third_party/gmail/src/contrib/apiOauth2Service.php';
	
	$client = new apiClient();
	$client->setApplicationName("shopsity");
	
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new apiOauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {



	$user = $oauth2->userinfo->get();
	
	
	
	$token_data = json_decode($_SESSION['token']);
	
	$this->page_api=ReplaceRecursive($this->page_api,'un',urlencode($user['email']));
	$this->page_api=ReplaceRecursive($this->page_api,'pwd',urlencode($token_data->access_token));
	$this->page_api=ReplaceRecursive($this->page_api,'snt',urlencode('GPLUS'));
	
	$this->data['mcurldata']=$this->CurlModel->callmulticurl($this->page_api);

	$output_data=json_decode($this->data['mcurldata']['curl_social_api']['response']);
	
		// echo "<pre>"; 
		// print_r($output_data);
		// exit;	
		// if($output_data->msg->code==2){			
			
	
		
		$this->session->set_userdata('LoginUsername', $output_data->rs->name);
		$this->session->set_userdata('LoginEmail', $output_data->rs->email);
		$this->session->set_userdata('LoginUserid', $output_data->rs->id);
		$this->session->set_userdata('Mobile', $output_data->rs->mobile);
		

		//$this->LoginModel->insert_facebook_entry($user_profile);
		if($this->session->userdata('LoginEmail'))
		{
		redirect($this->session->userdata('refferalurl'));
		
		}
       
        // } else if($output_data->msg->code== 1){
		 // $this->data['facebookoutput']=$output_data;

		// $this->load->view('uidesign/'.$this->data['layout_file']['popup']['ui'],$this->data);
		
        // }
	/*	$this->LoginModel->insert_gmail_entry($user);
		if(isset($_SESSION['LoginEmail']))
		{
		redirect(base_url());
		
		}*/
  //$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  redirect($authUrl);
}	
	
}

//popup function
public function Refferer()
{
	
	$this->page_api['curl_refferer_api']=$this->config->item('Login_API')['curl_refferer_api'];
		
	$this->page_api=ReplaceRecursive($this->page_api,'mobile',$_GET['mobile']);
	$this->page_api=ReplaceRecursive($this->page_api,'refCode',$_GET['refCode']);
	$this->page_api=ReplaceRecursive($this->page_api,'userId',$_GET['email']);
	
	$this->data['mcurldata']=$this->CurlModel->callmulticurl($this->page_api);
	
	$output_data=json_decode($this->data['mcurldata']['curl_refferer_api']['response']);
	
	if($output_data->st==1){
		$this->session->set_userdata('LoginUsername', $_GET['uname']);
		$this->session->set_userdata('LoginUserid', $_GET['user_id']);
		$this->session->set_userdata('LoginEmail', $_GET['email']);
		$this->session->set_userdata('Mobile', $_GET['mobile']);
	$output = array('ret_status' => $output_data->st,'ret_url'=>$this->agent->referrer());					
	}else
	{	
	$output = array('ret_status' => $output_data->st, 'msg' =>$output_data->er->message, 'res' => $output_data->rs);
	}
	echo json_encode($output);		
	
	
}
public function curlhandler()
	{
		$this->page_api=$this->config->item('Login_API');
		$this->page_api=ReplaceLocation($this->data['cityname'],$this->page_api);
		$this->data['mcurldata'] =$this->CurlModel->callmulticurl($this->page_api);
		
	}



}
