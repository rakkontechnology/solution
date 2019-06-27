<?php 
 $productdetail_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
 // echo "<pre>";
 // print_r($productdetail_data);
 // exit;
 $curl_get_user_profile=json_decode($mcurldata['curl_get_user_profile']['response']);
 if($productdetail_data->Data!=null)
 {
	 // echo "<pre>";
	 // print_R($_POST);
	 // exit;
	 ?>
	   <section class="deliveryWrap">
	   	<input type="hidden" name="storecode" value="<?php echo $_POST['storecode'];?>" id="storecode"/>
				<input type="hidden" name="vendorCode" value="<?php echo $_POST['vendorCode'];?>" id="vendorCode"/>
				<input type="hidden" name="sizeselcted" value="<?php echo $_POST['sizeselcted'];?>" id="sizeselcted"/>
				<input type="hidden" name="productid" value="<?php echo $_POST['productid'];?>" id="productid"/>
				<input type="hidden" name="latitude" value="<?php echo $latitude;?>" id="latitude"/>
				<input type="hidden" name="longitude" value="<?php echo $longitude;?>" id="longitude"/>
				<input type="hidden" name="userid" value="<?php echo $this->session->userdata('LoginUserid');?>" id="userid"/>
            <label class="option active">
                <input type="radio" class="radioBox" name="selectoptresult"   value="1" checked> 
                <span class="title"><?php echo $retrieveconstant['TEXT_PICK_STORE'];?></span>
            </label>
            <div class="pickStore">
                <p class="storeName"><?php echo  $productdetail_data->Data->Product->Store;?></p>
                <p class="contactNum"><?php echo  $productdetail_data->Data->Product->StoreMobile;?></p>
                <p class="address"><?php echo  $productdetail_data->Data->Product->StoreAddress;?></p>
            </div>
            <div class="homeDelivery">
               
                 <label class="option">
                    <input type="radio" class="radioBox" name="selectoptresult"  value="2"> 
                    <span class="title"><?php echo $retrieveconstant['TEXT_HOME_DELIVERED'];?></span>
                </label>
   <?php if($curl_get_user_profile->userAddress!=null){ 
						$addressadd='yes';
						?>
                <div class="userAddress">
                    <p class="storeName"><?php echo $curl_get_user_profile->userAddress->name;?></p>
                    <p class="contactNum"><?php echo $curl_get_user_profile->userAddress->mobileNumber;?></p>
                    <p class="address"><?php echo $curl_get_user_profile->userAddress->houseNumber.', '.$curl_get_user_profile->userAddress->street.', '.$curl_get_user_profile->userAddress->city.', '.$curl_get_user_profile->userAddress->state.'- '.$curl_get_user_profile->userAddress->pincode;?></p>
                </div>
				<?php } else {  
						$addressadd='no';
						?>
                <a href="<?php echo base_url().'userprofile'?>" class=""><?php echo $retrieveconstant['TEXT_ADD_NEW_ADD'];?></a>
				<?php  } ?>
            </div>
			 <!--<a href="<?php //echo $referurl;?>" class="btnDefault">Cancel</a>-->
            <a href="javascript:void(0)" onClick="PlaceOrderDone('<?php echo $addressadd;?>')" class="btnDefault">Done</a>
        </section>   
	 
	 
	


 <?php } ?>
