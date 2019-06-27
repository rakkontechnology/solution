<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends MY_model {

               public function __construct()
        {
                // Call the CI_Model constructor
               $this->load->database(); 
        }

          function insert_facebook_entry($data)
    {
		
		$this->date    = time();
		$query_facebook=$this->db->query("select * from users where oauth_uid='".$data['id']."' and oauth_provider='facebook'");
		if($query_facebook->num_rows()==0) {
			$query = $this->db->insert('users', array('oauth_provider' => 'facebook', 'oauth_uid' => $data['id'], 'username' => $data['name'],'email' => $data['email'],'reg_date'=>''));
    }
	/*$logindata = array(
                   'username'  => $data['name'],
                   'email'     => $data['email'],
                   'logged_in' => TRUE
               );*/
			 //  print_R($data);
			   $this->session->set_userdata('LoginUsername', $data['name']);
			   $this->session->set_userdata('LoginEmail', $data['email']);

}

    function insert_gmail_entry($data)
    {
	
		$this->date    = time();
		$query_facebook=$this->db->query("select * from users where oauth_uid='".$data['id']."' and oauth_provider='gmail'");
		if($query_facebook->num_rows()==0) {
			$query = $this->db->insert('users', array('oauth_provider' => 'gmail', 'oauth_uid' => $data['id'], 'username' => $data['name'],'email' => $data['email'],'reg_date'=>''));
    }
	/*$logindata = array(
                   'username'  => $data['name'],
                   'email'     => $data['email'],
                   'logged_in' => TRUE
               );*/
			 //  print_R($data);
			   $this->session->set_userdata('LoginUsername', $data['name']);
			   $this->session->set_userdata('LoginEmail', $data['email']);

}


}
?>