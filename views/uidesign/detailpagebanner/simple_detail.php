  <?php $detail_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
  // echo "<pre>";
  // print_r($detail_data);
  if($detail_data->Data!=null)
  {
  ?>
  <div class="productDescription clearfix">
            <p class="priceDetails">
                <span class="newPrice">&#x20B9;<?php echo $detail_data->Data->Product->SalePrice;?></span>
				<?php if($detail_data->Data->Product->DiscountPercent!=null) { ?>
                <span class="oldPrice">&#x20B9;<?php echo $detail_data->Data->Product->MRP;?></span>
                <span class="offer"><?php echo $detail_data->Data->Product->DiscountPercent;?>% Off</span>
				<?php }?>
            </p>
            <p class="storeName"><?php echo $detail_data->Data->Product->Brands;?></p>
            <p class="marketName"><?php echo $detail_data->Data->Product->Locality;?></p>
        </div>
		
  <?php }  else { ?>
  <div>Coming soon...</div>
  <?php } ?>