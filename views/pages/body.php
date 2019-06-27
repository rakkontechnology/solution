<?php 
// echo "<pre>";
// print_r($layout_file['response']);
// exit;
		if($layout_file['response']!=null)
{
foreach($layout_file['response'] as $key=>$val)
{
	 $this->load->view('uidesign/'.$val['ui'].'.php');
}
}
?>