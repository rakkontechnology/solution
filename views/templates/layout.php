
<!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<?php  echo base_url().DIR_IMAGES_PATH; ?>favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php  echo base_url().DIR_IMAGES_PATH; ?>favicon.ico" type="image/x-icon">
	<?php 	 $this->load->view('pages/headercss.php'); ?>
<title>Shopsity</title>
</head>

<body>
<?php 	 $this->load->view('pages/header.php'); ?>
<div class="container clearfix ">

<?php 	 $this->load->view('pages/body.php'); ?>
</div>
 <footer>

<?php 	 $this->load->view('pages/footer.php'); ?>
 </footer>
 
<?php 	 $this->load->view('pages/footerjs.php'); ?>
 
 </body>
</html>
<?php
if(SHOW_ELAPSED_TIME==true)
{
echo "<div>Page-Elapsed-Time: ".$this->benchmark->elapsed_time()."</div>";
}


?>