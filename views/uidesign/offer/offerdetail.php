<?php
	$offer_data=json_decode($mcurldata['curl_offer']['response']);
			// echo "<pre>";
				// print_r($offer_data);
			// exit;
		if($offer_data->Data !=null){
			?>

<section class="offersTemplate clearfix">
            <h2><?php echo $retrieveconstant['TEXT_OFFER_HEADING'];?></h2>
            <div class="offersAvailable">
			<?php
		
			foreach($offer_data->Data as $key=>$val)
			{
				$titleBrand=preg_replace("/[\/\'&%#\$_]/", "-", $val->Brands);
				$titleBrand=str_replace(' ','-',$titleBrand);
			?>
			<a href="<?php echo base_url().strtolower(Cityreplacecharacter($cityname).'/'.str_replace(' ','-',$seg2name).'/'.$titleBrand.'?'.'Brands='.$val->Brands.'&OfferId='.$val->OfferId);?>">
                <span class="offerOption"><?php echo $val->Brands.': '.$val->OffersDetails;?></span>
				</a>
			<?php } 
		
			?>
            </div>
        </section>
		<?php
		}
		?>