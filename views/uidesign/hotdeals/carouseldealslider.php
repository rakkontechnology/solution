<?php
$deal_data=json_decode($mcurldata['curl_deal_banner']['response']);
// echo "<pre>";
			// print_r($deal_data);
			// exit;
			// south_delhi/?offerid=31
if($deal_data->Products!=null)
{
?>

<section class="dodBanners clearfix">
     <h2><?php echo $retrieveconstant['TEXT_DEALS_TITLE'];?><a class="viewAll" href="<?php echo base_url().strtolower(Cityreplacecharacter($cityname)).'/product?offerid=31'; ?>">View All</a></h2>
           
            <div id="dodBanners" class="owl-carousel">
			
			<?php
			/*if($this->router->fetch_class()=='productdetail')
			{
				$deal_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
				foreach($deal_data->Data->SimilarProduct as $key=>$val)
			{
				$title=$val->Title;
				$title=substrwords($title,30,'');
				$title=ReplaceSpecialHyphen($title);
?>
<a href="<?php echo base_url().strtolower(str_replace(' ','_',$cityname).'/'.$title.'/'.$val->Id);?>">
				
                <div>
                    <div class="dealsProducts" style="background:url('<?php echo $val->Image;?>');"></div>
                    <div class="productDescription">
                        <p class="priceDetails">
						
                            <span class="newPrice">&#x20B9;<?php echo $val->SalePrice;?></span>
							<?php if($val->DiscountPercent!=null) { ?>
                            <span class="oldPrice">&#x20B9;<?php echo $val->Price;?></span>
                            <span class="offer"><?php echo $val->DiscountPercent;?>%</span>
							<?php } ?>
                        </p>
                        <p class="storeName"><?php echo $val->Brands;?></p>
                        <p class="marketName"><?php echo $val->Locality;?></p>
                    </div>
                </div>
				</a>
			<?php }
			} 
			else
			{*/
			
			
			
			foreach($deal_data->Products as $key=>$val)
			{
				// $title=$val->Title;
				// $title=substrwords($title,30,'');
				$title=ReplaceSpecialHyphen($val->PdPageUrl);
?>
<!--<a href="<?php //echo base_url().strtolower(str_replace(' ','-',$cityname).'/'.$title.'/'.$val->Id);?>">-->
<a href="<?php echo base_url().$title;?>">

                <div>
                    <div class="dealsProducts" style="background:url('<?php echo $val->Images[0];?>');"></div>
                    <div class="productDescription">
                        <p class="priceDetails">
						<span class="newPrice">&#x20B9;<?php echo $val->SalePrice;?></span>
						<?php if($val->DiscountPercent!=null) { ?>
                            
                            <span class="oldPrice">&#x20B9;<?php echo $val->MRP;?></span>
                            <span class="offer"><?php echo $val->DiscountPercent;?>% Off</span>
						<?php } ?>
                        </p>
                        <p class="storeName ellip"><?php echo $val->Brands;?></p>
                        <p class="marketName ellip"><?php echo $val->Locality;?></p>
                    </div>
                </div>
				</a>
			<?php }
			//}
				?>
			
                
            </div>
        </section>
<?php } ?>
    
	