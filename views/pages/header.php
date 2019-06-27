<?php 
 
if($layout_file['header']!=null)
{
foreach($layout_file['header'] as $key=>$val)
{
	
	 $this->load->view('uidesign/'.$val['ui'].'.php');
}
}
?>
