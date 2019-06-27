 <section class="catalougeWrap clearfix" id="productslidewrap">
 
           <ul>
		   <div id="product_data_apend">
		 <?php 	 
		 $product_data=json_decode($mcurldata['curl_get_products']['response']);
		// echo "<pre>";
		// print_r($product_data);
		// exit;
		  if($product_data->Products!=null)
		 {
		 $this->load->view('templates/ajax_productslisting.php'); 
		 
		 } else { ?>
		 
		    <div class="productDescription"> <?php echo 'No more products';?></div>
		 <?php } ?>
                </div>
				  
			
			
    <div class="inlineLoader displayNone" id="LoaderDiv">
       <img src="<?php echo base_url().DIR_IMAGES_PATH;?>loader2.gif" />
    </div>
			
		
			
           </ul>
		   <span id="startindex" class="displayNone"><?php echo $product_data->StartIndex;?></span>
		     <span id="lastpagenum" class="displayNone">0</span>
		    <span id="total-page" class="displayNone"><?php  echo ceil($product_data->TotalProduct/$product_data->StartIndex);?></span>
			<span id="pagenumber" class="displayNone"><?php echo $pagenumber;?></span>
				<span id="url" class="displayNone"><?php echo str_replace(' ','-',$product_data->Url);?></span>
			
        </section>

  <div class="downloadAppProduct">
		  
<a href="#" class="downloadApp">
            <b class="allIcon appLogoIcon"></b> Download Shopsity App
</a>	
 </div>