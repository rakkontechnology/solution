<?php
 $productdetail_data=json_decode($mcurldata['curl_get_productsdetail']['response']);
 // echo "<pre>";
 // print_r($productdetail_data);
 // exit;
 if($productdetail_data->Data!=null)
 {
 ?>
<section class="sizeOptionsWrap">
<form name="shortlisted" id="shortlisted" method="post" action="<?php echo base_url().'productdetail/checkout'?>">


            <?php
 if(count($productdetail_data->Data->Product->AvailableSize)<=5)
                {
                     echo '<h3>'.$retrieveconstant['TEXT_SELECT_SIZE'].'</h3>';
                    echo '<div class="fewSizesAvail"> <ul class="clearfix" id="select_size_grid">';
 foreach($productdetail_data->Data->Product->AvailableSize as $key=>$val)
            {
                ?>


                    <li class="" id="<?php echo $val;?>" ><?php echo $val;?></li>


                <?php }
                echo '</ul></div>';
                }   else {
    echo ' <div class="moreSizesAvail"><select name="sizeoptionselect" id="sizeoptionselect" >';
    echo '<option value="">Please select size</option>';
 foreach($productdetail_data->Data->Product->AvailableSize as $key=>$val)
                    {

                ?>
                    <option value="<?php echo $val;?>"><?php echo $val;?></option>

            <?php }
            echo '  </select></div>';
            } ?>
            <input type="hidden" name="storename" id="storename" value="<?php echo $productdetail_data->Data->Product->Store;?>">
            <input type="hidden" name="sizeselcted" id="sizeselcted">
            <input type="hidden" name="session_email_id" value="<?php echo $this->session->userdata('LoginEmail');?>"/>
        <input type="hidden" name="session_phone" value="<?php echo $this->session->userdata('Mobile');?>"/>
            <input type="hidden" name="storecode" value="<?php echo $productdetail_data->Data->Product->StoreId;?>"/>
                <input type="hidden" name="vendorCode" value="<?php echo $productdetail_data->Data->Product->VendorId;?>"/>

            <input type="hidden" name="productid" id="productid" value=" <?php echo $productdetail_data->Data->Product->Id; ?>">
            <div class="storeAddr">
                    <?php echo $productdetail_data->Data->Product->StoreAddress; ?>
                    <?php if($productdetail_data->Data->Product->Latitude!=null && $productdetail_data->Data->Product->Longitude!=null){ ?>
            <?php } ?>
            </div>

            <?php /*onclick="pixelcontroll('<?php echo $productdetail_data->Data->Product->StoreId;?>','<?php echo $productdetail_data->Data->Product->VendorId;?>')" */?>

            <div class="callShortlist clearfix">
                <div class="map">
                    <a  href="javascript:void(0)" onClick="showmap('<?php echo $productdetail_data->Data->Product->Latitude;?>','<?php echo $productdetail_data->Data->Product->Longitude;?>')">
                        <b class="allIcon mapIcon"></b>
                    </a>
               </div>
                <div class="phone">
                    <a href="tel:+<?php echo preg_replace('/^0/',"91",($productdetail_data->Data->Product->StorePhone!='' ? $productdetail_data->Data->Product->StorePhone : '09999999999' ));?>" class="pixelclickcontrol"><b class="allIcon callIcon"></b></a>
                    <a id="callclickbutton" class="displayNone" href="tel:+<?php echo preg_replace('/^0/',"91",($productdetail_data->Data->Product->StorePhone!='' ? $productdetail_data->Data->Product->StorePhone : '09999999999' ));?>"><b class="allIcon callIcon"></b></a>
                </div>

                <?php if($productdetail_data->Data->Product->IsOutofStock==true){ echo ' <div class="shortList"><a href="#">'.$retrieveconstant['TEXT_OUT_OF_STOCK'].'</a>';
                } else {

if($productdetail_data->Data->Product->IsExclusiveShopSityPartner==false)
                 {
                     $anchor_tag=' <div class="shortList Reservedisabled"><a href="javascript:void(0)" onClick="CheckShopsityPartner()">';
                 } else
                 {
                     $anchor_tag='<div class="shortList"><a href="javascript:void(0)" onClick="CheckLoginState(\''.base_url().'\')">';

                 }


                echo $anchor_tag.$retrieveconstant['TEXT_SHORTLIST'].'</a>';

                } ?>


                </div>
            </div>
            </form>
        </section>
        <?php
        } else
        {

        echo "Coming soon...";
        }
        ?>