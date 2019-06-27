
<?php 	 
if($mcurldata['curl_get_products']['response']!=null)
{
		 $product_data=json_decode($mcurldata['curl_get_products']['response']);
}
		 // echo "<pre>";
		 // print_r($product_data);
		 // exit;
		 if($product_data->Products!=null)
		 {
		 	foreach($product_data->Products as $key=>$val)
			{
				// echo "<pre>";
				// print_r($val->PdPageUrl);
				// exit;
				$title=ReplaceSpecialHyphen($val->PdPageUrl);
				//echo $title;
?>
<!--<a href="<?php //echo base_url().strtolower(str_replace(' ','_',$cityname).'/'.$title.'/'.$val->Id);?>">-->
<a href="<?php echo base_url().$title;?>">

  <li>
                    <div class="catalougeProducts" style="background:url('<?php echo ($val->Images!=null ? $val->Images[0] :'');?>');">
						<?php  if ($val->StoreShopsityExclusiveDiscountType==1 && $val->StoreShopsityExclusiveDiscountValue!=''){ ?>
					 <span class="ribbon">Shortlist &amp; Get <?php echo $val->StoreShopsityExclusiveDiscountValue ;?> % off </span>
						<?php }
				if($val->StoreShopsityExclusiveDiscountType==2 && $val->StoreShopsityExclusiveDiscountValue!='')
				{ ?> 
			 <span class="ribbon">Shortlist &amp; Get <?php echo $val->StoreShopsityExclusiveDiscountValue; ?> Cashback</span>
			 <?php } ?>
					</div>
                    <div class="productDescription">
                        <p class="priceDetails ellip">
                            <span class="newPrice">&#x20B9;<?php echo $val->SalePrice;?></span>
							<?php if($val->DiscountPercent!=null){ ?>
                            <span class="oldPrice">&#x20B9;<?php echo $val->MRP;?></span>
                            <span class="offer"><?php echo $val->DiscountPercent;?>% Off</span>
							<?php } ?>
                        </p>
                        <p class="storeName ellip"><?php echo $val->Brands;?></p>
                        <p class="marketName ellip"><?php echo $val->Locality;?></p>
                    </div>
               </li> </a>
			<?php } 
		 }
		 else
		 {
			echo '<li id="EndOfProducts" class="displayNone">';
			 echo 'Nothig Exist';
			 echo '</li>';
		 }
		 ?>
		 