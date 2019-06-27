  <?php
  // echo "<pre>";
 //// echo $this->router->fetch_class();->Data->Products[0]->Images
  // $productdetail_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
  // echo "<pre>";
		// print_r( $productdetail_data);
		// exit;
		
		?>
	
		
   <section class="<?php echo $layout_file['response']['homebanner']['class']?> clearfix">
            <div id="hBanners" class="owl-carousel">
			<?php
			if($this->router->fetch_class()=='productdetail')
			{
			$productdetail_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
			if($productdetail_data->Data!=null)
			{
			if(sizeof($productdetail_data->Data->Product->Images)>0)
			{
			foreach($productdetail_data->Data->Product->Images as $key=>$val)
			{
				
				?>
			<div class="dealsProducts" style="background:url('<?php echo $val;?>');"> 
			<?php  if ($productdetail_data->Data->Product->StoreShopsityExclusiveDiscountType==1 && $productdetail_data->Data->Product->StoreShopsityExclusiveDiscountValue!=''){ ?>
				
				<span class="ribbon">Shortlist & get <?php echo $productdetail_data->Data->Product->StoreShopsityExclusiveDiscountValue ;?> % off </span>
				<?php }
				if($productdetail_data->Data->Product->StoreShopsityExclusiveDiscountType==2 && $productdetail_data->Data->Product->StoreShopsityExclusiveDiscountValue!='')
				{ ?> 
				<span class="ribbon">Shortlist & get &#8377;<?php echo $productdetail_data->Data->Product->StoreShopsityExclusiveDiscountValue;  	?> Cashback </span>
				<?php } ?>
			
			
			</div>
			
			
				<?php
			}
			}
			}
			
				
			}
			else
			{
			$banner_data=json_decode($mcurldata['curl_banner']['response']);
			// echo "<pre>";
			// print_r($banner_data);
			if($banner_data->rs!=null)
			{
			foreach($banner_data->rs as $key=>$val)
			{
				$serachparamval=array_combine(explode(',',$val->searchParams),explode(',',$val->searchValues));
				
				
				//echo $val->searchParams;
				$anchor_start='';
				$anchor_end='';
				if(array_key_exists(STORE_NAME_SERACH_PARAM,$serachparamval))
				{
	$anchor_start='<a href="'.base_url().strtolower(Cityreplacecharacter($cityname)).'/product?storename='.$serachparamval[STORE_NAME_SERACH_PARAM].'">'; 
				$anchor_end='</a>';
				}
				echo $anchor_start;
				?>
			<div class="dealsProducts" style="background:url('<?php echo $val->imageURL;?>');"></div>	
				
				<?php
			echo $anchor_end;
			}
			}
			}
			?>
            </div>
        </section>
		<?php
			if($this->router->fetch_class()=='productdetail')
			{
			
			$this->load->view('uidesign/detailpagebanner/simple_detail');
			}
			?>
