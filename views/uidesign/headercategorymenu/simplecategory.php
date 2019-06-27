
  <div Class="shopChange">
 <?php if($cityname!=null){ ?>
<p class="shopLink">You are in <?php echo ucfirst(str_replace('*',' ',$cityname));?></p>
 <?php } ?>
 <a href="javascript:void(0)" class="locationLink" onclick="javascript:locationpopup()"><?php echo $retrieveconstant['HEADING_LOCATION_CHANGE'];?></a>
  </div>
   <div class="mainOptions borderTop">
 <a href="#" class="shopLink"><?php echo $retrieveconstant['HEADING_CATEGORY_MENU'];?></a>
 </div>
            <div class="categoryOptions clearfix">
			<?php
			$shop_by_cat=json_decode($mcurldata['curl_shop_by_cat']['response']);
			// echo "<pre>";
				// print_r($shop_by_cat);
			// exit;
			if($shop_by_cat->Data!=null)
			{
			 foreach($shop_by_cat->Data as $key=>$val)
			 {
				 echo '<div><a href="'.base_url().$val->MasterUrl.'">'.$val->Label.'</a></div>';
			 }
			}
			?>
            </div>
			
			