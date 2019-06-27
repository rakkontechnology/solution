        <div class="orderNotification displayNone">
         <?php echo $retrieveconstant['TEXT_FIRST_PICKED_ORDER'];?>
        </div>
       <section class="orderTemplate clearfix">
            <ul>
			<?php 	 
		 $product_data=json_decode($mcurldata['curl_get_orders']['response']);
		 // echo "<pre>";
		 // print_r($product_data);
		 // exit;
		 if($product_data->Data!=null)
		 {
		 	foreach($product_data->Data as $key=>$val)
			{
		 ?>
			
                <li>
                    <section class="orderInfoWrap clearfix"> 
                   <div class="leftPane">
				   <?php 
				   $product_url=$val->OrderItems[0]->ProductName;
				
				$product_url=ReplaceSpecialHyphen($product_url);
				   ?>
                        <?php /*<a href="<?php echo base_url().str_replace(' ','-',$cityname).'/'.$product_url.'/'.$val->OrderItems[0]->ProductId;?>" >*/ ?> <div class="catalougeProducts" style="background:url('<?php echo $val->OrderItems[0]->ProductUrl;?>');"></div><!--</a>-->
                        <button class="statusBtn"><?php echo $retrieveconstant['TEXT_ORDER_PLACED'].$val->OrderStatusDescription;?></button>
                    </div>
                    <div class="rightPane">
                        <p><?php echo $retrieveconstant['TEXT_ORDER_NUMBER'];?><span class="floatRight"><?php echo $val->OrderNumber;?></span></p>
                        <p><?php echo $val->OrderItems[0]->ProductName;?></p>
                        <p><?php echo $retrieveconstant['TEXT_SIZE'];?> <span  class="floatRight"><?php echo $val->OrderItems[0]->ProductSize;?></span></p>
                        <p><?php echo $retrieveconstant['TEXT_PRICE'];?>  <span class="floatRight"><?php echo number_format($val->OrderItems[0]->SalePrice); ?></span></p>
                        <p><?php echo $retrieveconstant['TEXT_CASHBACK'];?>   <span class="floatRight"><?php echo number_format($val->OrderItems[0]->EarnableCashback);?></span></p>
                        <div class="fullAddrPane">
                            <p class="heding">  <?php echo ucfirst(urldecode($val->OrderItems[0]->StoreName));?></p>
                            <p class="subHeding"><?php echo $val->OrderItems[0]->StoreAddress;?></p>
                        </div>
                    </div>
                    </section>
                    <section class="actionPane clearfix">
					<?php if($val->OrderStatusDescription=='Cancelled'){ ?>
                        <a href="javascript:void(0)"> <button class="btnDefault cancelBtn" ><?php echo $retrieveconstant['TEXT_CANCELED_ORDER'];?> </button></a>
					<?php }  else { ?>
					 <a href="javascript:void(0)" onclick="cancelOrderClick('<?php echo $val->OrderItems[0]->Orders_Id;?>')"> <button class="btnDefault cancelBtn" ><?php echo $retrieveconstant['TEXT_CANCEL_ORDER'];?> </button></a>
					<?php } ?>
                        <button class="btnDefault callBtn">
                            <a href="tel:+<?php echo $val->OrderItems[0]->StorePhone;?>"><b class="allIcon callIcon"></b></a>
                        </button>
                    </section>
                </li>
		 <?php }  }	else { 
		 echo "Not any order found";
		 } ?>
               
           </ul>
        </section>
		
		
   