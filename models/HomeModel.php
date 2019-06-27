<?php defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends MY_model {

               public function __construct()
        {
                // Call the CI_Model constructor
               $this->load->database(); 
        }

}

?>