
<?php 
 $contactus_info_data=json_decode($mcurldata['contactus_info']['response']);
 // echo "<pre>";
 // print_r($contactus_info_data->Data);
 // exit;
 if($contactus_info_data->Data!=null)
 {
 ?>
 <section class="contactUS clearfix">
      <h2><?php echo $retrieveconstant['TEXT_ADDRESS'];?> </h2>
		<div class="fullAddress">
		<p><?php echo $contactus_info_data->Data->Address;?></p>
		<p><?php echo $retrieveconstant['TEXT_PHONENUMBER'];?> <?php echo $contactus_info_data->Data->ContactNumber;?> <a href="tel:<?php echo $contactus_info_data->Data->ContactNumber; ?>">Call us</a></p>
		<p><?php echo $retrieveconstant['TEXT_EMAIL'];?> <?php echo $contactus_info_data->Data->Email;?></p>
		</div>
 </section>
 <?php } else { ?>
 <div>Coming soon...</div>
 <?php } ?>