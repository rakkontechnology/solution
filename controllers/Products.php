<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_controller{

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
		$this->fileincluded('products');
		$this->load->view('templates/layout',$this->data);
	}
	public function curlhandler()
	{
		
	}

	

}
