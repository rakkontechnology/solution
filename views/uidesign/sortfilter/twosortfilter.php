<section class="sortNfilter clearfix">
           <div class="relative">
		   <?php
		   // $product_data=json_decode($mcurldata['curl_get_products']['response']);
		   // echo "<pre>";
		   // print_r($product_data);
		   // exit;
		   ?>
               
				<div class="sortAction">
                    <p class="head"><?php echo $retrieveconstant['TEXT_SORT'];?></p>
                   <p class="subHead" id="sortfiltershow"><?php //echo $retrieveconstant['TEXT_POPULARITY'];?></p>
					
                  	<?php
					$product_data=json_decode($mcurldata['curl_get_products']['response']);
					
					?>
                  
                </div>
				<?php
				if($product_data->Facets!=null)
				{
					// echo "<pre>";
					// print_r($product_data->Facets->Sorting);
					// exit;
				?>
				 	<select class="sort_h"  name="sorting" id="sortingfilter" >                    
						<?php foreach($product_data->Facets->Sorting as $key =>$value){ ?>		
						<option value="<?php echo $value->Url;?>" for="<?php echo $value->Url;?>"  name="<?php echo $value->Label;?>" <?php echo $value->IsSelected== true ? "selected=selected" : '' ; ?>><?php echo $value->Label;?></option>
						<?php } ?>	
						</select>
				<?php } ?>
            </div>
            <div class="borderLeft">
			<a href="javascript:void(0)" onClick="javascript:commonpopup()">
                <div class="filterAction">
                    <p class="head"><?php echo $retrieveconstant['TEXT_FILTER'];?></p>
                    <p class="subHead"><?php echo $retrieveconstant['TEXT_APPLY_FILTER'];?></p>
                </div></a>
            </div>
        </section>


  