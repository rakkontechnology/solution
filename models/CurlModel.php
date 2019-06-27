<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CurlModel extends MY_model {

               public function __construct()
        {
                // Call the CI_Model constructor
               $this->load->database(); 
        }

        public function callmulticurl($apidata)
        {
        AddMultiCurl($apidata);
		$output=$this->mcurl->execute();
		//$this->mcurl->debug();
		return $output;
        }

}

?>