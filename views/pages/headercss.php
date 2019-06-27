<?php 
if($layout_file['css']!=null)
{
foreach($layout_file['css'] as $key=>$val)
{
	echo '<link rel="stylesheet" href="'.base_url().STYLE_SHEET_CSS_PATH.$val.'.css?v='.RANDOM_VALUE_FOR_JS_CSS.'"  type="text/css"/>';
}
}
?>