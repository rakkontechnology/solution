<?php  /*       
			<section class="staticpage">
			  <h3> SItycash Bal</h3>
			  	<?php
			$curl_get_shopsitycash=json_decode($mcurldata['curl_get_shopsitycash']['response']);
			// echo "<pre>";
			// print_r($curl_get_shopsitycash);
			// exit;
			if($curl_get_shopsitycash->Data!=null)
			{
			?>
			<div> Balance:- <?php echo $curl_get_shopsitycash->Data->Balance;?></div>
			<div>
			<span>Date</span> <span>Summary</span> <span>Credit/Debit</span> <span>Balance</span>
			</div>
			<?php
			 foreach($curl_get_shopsitycash->Data->TransactionHistory as $key=>$val)
			 {
					?>
					<div>
			<span><script> document.write(dateconversion('<?php echo $val->Created; ?>')); </script></span> <span><?php echo $val->Description;?></span> <span><?php echo $val->Amount;?></span> <span><?php echo $val->Balance;?></span>
			</div>
					<?php
			 }
			}
			?>
			
         
        </section>
  */
?>
 <section class="appWrapHeader">
			<div class="companyLogo"><b class="allIcon logoIconBig"></b></div>
			<h2>Download App</h2>
			<p>for best Shopping Experience</p>
			<div class="googlePlayLogo"><a href="https://play.google.com/store/apps/details?id=com.shopsity"><b class="allIcon googlePlayIcon"></b></a></div>
	   </section>
	   <section class="appWrapBody">
			<h2>The feature is only available in the mobile app</h2>
			<ul class="">
				<li>Get Notifications for exclusive offers and discounts 
  for stores near you</li>
				<li>Follow Stores for exclusive update on their catalog</li>
				<li>Get and avail your sity cash balance on our 
  exclusive partner stores</li>
				<li>Refer your friends and earn sity cash</li>
			</ul>
	   </section>

