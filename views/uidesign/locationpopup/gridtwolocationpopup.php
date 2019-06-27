<div class="bodyMask" id="locationPopUp">
        <section class="fullwidthPop locationPopUp">
		<?php
		//echo $cityname;
		// echo "<pre>";
		// print_r($all_location_exist);
		// echo '---------'.$cityname;?>
        <h2>Change Location<button class="btnDefault cancelBtn closeMe" >Back</button></h2>
		<h3><?php echo $retrieveconstant['TEXT_LOCATION_POPUP_HEADING'];?></h3>
        <div class="locationsNearby clearfix">
            <ul>
			<?php 
			if($all_location_exist!=null)
			{
			foreach($all_location_exist as $key=>$val){ ?>
                   <li class="commonRadioBtn clearfix">
                        <label class="options">
                            <a href="<?php echo base_url().Cityreplacecharacter(strtolower($val['Zone']));?>"><span class="radioBox <?php echo (ucwords(CityReplaceRevertCity(strtolower($cityname)))==$val['Zone'] ? 'checked' :'');  ?>"></span>
                            <span><?php echo $val['Zone'];?></span></a>
                        </label>
                    </li>
			<?php }  }?>
             
            </ul>
        </div>
        </section>    
    </div>
	
