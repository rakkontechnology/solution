<?php
$shop_by_cat=json_decode($mcurldata['curl_shop_by_cat']['response']);
			// echo "<pre>";
			// echo $seg2name;
			// print_r($shop_by_cat->Data);
			// exit;
			if($shop_by_cat->Data!=null){
				// echo "sssss";
				?>

<section class="navigateProducts clearfix">
            <ul>
                <li><a href="javascript:void(0);"><?php echo $retrieveconstant['TEXT_CATEGORY_HEADING'];?></a></li>
				<?php
			
			 foreach($shop_by_cat->Data as $key=>$val)
			 {
				 // echo ucwords(CityReplaceRevertCity($seg2name));
				 // exit;
				 // echo "<pre>";
				// echo count($val->Menus);
				// print_r($val->For);
				// echo $seg2name;
				// exit;
				 if($val->For===$seg2name)
				 {
				
					// id="openMe_'.$icount.'"
						 if(count($val->Menus)>0)
						 {
							 $icount=1;
						 foreach($val->Menus as $subkey=>$subval)
							{	
								
								if($subval->IsLink==true)
								{
									$classhref='href="'.base_url().$subval->Url.'"';
								} else
								{
										$classhref='href="javascript:void(0)"  class="openMe"';
								}
							 echo '<li><a '.$classhref.' id="hide">'.$subval->Label.'</a>';
							 if(count($subval->Menus)>0)
						 {
							echo '<ul class="subMenu">';
						 foreach($subval->Menus as $subsubkey=>$subsubval)
							{	
							 echo '<li>'.anchor($subsubval->Url, $subsubval->Label, 'title='.$subsubval->Label).'</li>';
							}
							echo '</ul></li>';
						 } else
						 {
							 	echo '</li>';
							 continue;
						 }
						
							$icount++;
							}
						}
						else
						{
							 continue;
						}
				}
			
			} 
			
			?>
              

            </ul>
        </section>
		<?php
		} 
		?>