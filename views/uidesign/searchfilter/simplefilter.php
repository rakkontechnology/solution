<?php
$filter_data=json_decode($this->data['mcurldata']['curl_get_products_filter']['response']);
//$val=$filter_data->Data;
// echo "<pre>";
// print_r($filter_data);
// exit;

	

?>
<div class="bodyMask" id="commonPopUp">
        <section class="fullwidthPop locationPopUp" id="CommonDetailData">
		 <h2>Filter <button class="btnDefault cancelBtn closeMe" >Back</button> </h2>
		
		 <div id="CommonPopupdata">
           
             <section class="filterWrapper clearfix">
                <!--<h3>Refine</h3>-->
				<?php
				if($filter_data->Facets!=null)
				{

				?>
                 <div class="filterList clearfix">
                    <div class="leftOptions clearfix">
                        <ul>
						<?php
						$j=1;
						foreach($filter_data->Facets->FacetInfo as $key=>$value)
						{
							// echo "<pre>";
							// print_r($value->ChildFilters);
							if(sizeof($value->SubFacetInfo)>0)
							{
								//echo $value->FilterFriendlyName;
								
							echo '<li class="mainCat_h '.($j==1 ? 'active' : '').'" data-id="'.strtolower($value->Name).'">'.$value->FriendlyName.'</li>';
							}
					
						$j++;}
						?>
						
                          <!--  
                            <li class="mainCat_h" data-id="category">Category</li> 
                            <li class="mainCat_h" data-id="size">Size</li>
                            <li class="mainCat_h" data-id="gender">Gender</li>
                            <li class="mainCat_h" data-id="brands">Brands</li>
                            <li class="mainCat_h" data-id="colour">Colour</li>
                            <li class="mainCat_h" data-id="offers">Offers</li>
                            <li class="mainCat_h" data-id="price">Price</li>
                            <li class="mainCat_h" data-id="locality">Locality</li>-->
                        </ul> 
                    </div> 
                    <div class="rightOptions clearfix">
					<?php
					$i=1;
						foreach($filter_data->Facets->FacetInfo as $key=>$value)
						{
									// echo "<pre>";
							// print_r($value);
							?>
                     
						<?php
						if($value->Name=='sale_price')
						{
							if(sizeof($value->SubFacetInfo)>0)
						{
							// echo "<pre>";
							// print_r($value->ChildFilters[0]);
							?>
							 <ul class="depart subCat_h" id="<?php echo strtolower($value->FilterName);?>">
							
                             <li>
                                <label>
                                   <span class="title">Min Price:</span>
                                   <select name="minprice">
                                       <option value="">Select Min Price</option>
									   <?php
									   	foreach($value->ChildFilters[0]->FromPrice as $minprice)
										{
									   echo '<option '.($minpricesend==$minprice ? "selected=selected" : "") .'>'.$minprice.'</option>';
                                        }
										?>
                                    </select>
                                </label>
                            </li>
							
							  <li>
                                <label>
                                    <span class="title">Max Price:</span>
                                   <select name="maxprice">
                                       <option  value="">Select Max Price</option>
                                        <?php
									   	foreach($value->ChildFilters[0]->ToPrice as $maxprice)
										{
									   echo '<option '.($maxpricesend==$maxprice ? "selected=selected" : "") .'>'.$maxprice.'</option>';
                                        }
										?>
                                    </select>
                                 </label>
                            </li>
						
                        </ul>
							
							<?php
						}
						}else
						{
							?>
							   <ul class="depart <?php echo ($i==1 ? 'show' : '')?> subCat_h" id="<?php echo strtolower($value->Name);?>">
						<?php	
				
						if(sizeof($value->SubFacetInfo)>0)
						{
						
							$i=1;
						foreach($value->SubFacetInfo as $id=>$subvalue)
						{
							
						?>
						
                           <li <?php if($subvalue->IsSelected==true){ echo 'class=filterActive'; } ?>>
								<a href="<?php echo base_url().$subvalue->Url;?>">
                                    <span class="dataTxt"><?php echo $subvalue->Name;?></span>
                                </a>
                            </li>
						
						<?php $i++;} 
						} 
						?>
						  </ul>
						<?php
						}
						?>
                            
                      
						<?php $i++;} ?>
						
						
                         
                    </div> 
                 </div>
				 <?php } else{  ?>
				 <div>No filter found.</div>
				  			 <?php } ?>
							  
             </section>

  
 </div>
        </section>    
    </div>
		