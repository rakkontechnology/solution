              <section class="loginFormWrap">
			<?php
			
	// echo "<pre>";
	// print_r($facebookoutput);
		// exit;
			?>
            <form class="actionForm" name="loginform" id="loginform">
                <ul>
                    <li>
					<label>
					<p style="color:red" id="resp_error"></p>
					</label>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_REFFERER'];?></p>
						<?php	echo form_input(array('name'=>'refferer','value'=>'')); 
						echo '<input type="hidden" name="emailid" value="'.$facebookoutput->rs->email.'"/>';
						echo '<input type="hidden" name="uname" value="'.$facebookoutput->rs->name.'"/>';
						echo '<input type="hidden" name="user_id" value="'.$facebookoutput->rs->id.'"/>';
							echo '<input type="hidden" name="baseurl" value="'.base_url().'"/>';
									
						?>
                          
                        </label>
						<p id="reffer_error"  style="color:red"></p>
                    </li>
					<li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_MOBILE'];?></p>
						<?php	echo '<input type="tel" name="mobilenumber"  id="mobilenumber" value="" maxlength="10"/>' ; ?>
                          
                        </label>
							<p id="mobile_error"  style="color:red"></p>
                    </li>
					
                     
                    <li>
					
					<?php echo form_button($retrieveconstant['TEXT_REFFERER_BUTTON']['button_name'],$retrieveconstant['TEXT_REFFERER_BUTTON']['heading'],$retrieveconstant['TEXT_REFFERER_BUTTON']['para']);?>
                    </li>
                </ul>
                
            </form>
       
        </section>
  <?php
foreach($this->data['layout_file']['popup']['js'] as $key=>$val)
{
  echo '<script src="'.base_url().JAVASCRIPT_PATH.$val.'.js?v='.RANDOM_VALUE_FOR_JS_CSS.'" type="text/javascript"></script>';
  
}
?>