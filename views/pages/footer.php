<?php 
		if($layout_file['footer']!=null)
{
foreach($layout_file['footer'] as $key=>$val)
{
	 $this->load->view('uidesign/'.$val['ui'].'.php');
}
}
?>