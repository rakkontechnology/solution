 <section class="shopByCat clearfix">
            <h2><?php echo $retrieveconstant['TEXT_SHOP_BY_CAT_HEADING'];?></h2>
            <ul class="catOptions clearfix">
			<?php
			$shop_by_cat=json_decode($mcurldata['curl_shop_by_cat']['response']);
			// echo "<pre>";
			// print_r($shop_by_cat);
			// exit;
			if($shop_by_cat->Data!=null)
			{
			 foreach($shop_by_cat->Data as $key=>$val)
			 {
					
				 echo '<li>'.anchor(base_url().$val->MasterUrl, $val->Label, 'title='.$val->Label).'</li>';
			 }
			}
			?>
            </ul>
        </section>