          <section class="userHeader">
		  <?php
		 $curl_get_shopsitycash=json_decode($mcurldata['curl_get_shopsitycash']['response']);
		 //$curl_user_info=json_decode($mcurldata['curl_user_info']['response']);
		 $curl_get_user_profile=json_decode($mcurldata['curl_get_user_profile']['response']);
		// echo "<pre>"; 
		// print_r($curl_get_user_profile);
		// exit;	
		  ?>
            <div class="userImage">
			<p id="successmsg" style="color:green"></p>
			
                <img src="<?php echo base_url().DIR_IMAGES_PATH;?>use_img/male.png" alt="user image"/>
            </div>
            <div class="userInfo">
			
				<input type="hidden" accept="text/plain"  name="profile_useremail" class="numberUser" value="<?php echo $this->session->userdata('LoginEmail');?>" />
			
            </div>
		
			
        </section>
        <section class="userDetails">
            <div class="totalOrders profileBox displayNone">
                <h2><?php echo $retrieveconstant['TEXT_ORDER'];?></h2>
                <p class="headinfo"><?php echo $retrieveconstant['TEXT_TOTAL_ORDER'];?></p>
                <p class="subHeadInfo"><?php echo $retrieveconstant['TEXT_VEW_ALL_ORDER'];?> <span>></span></p>
            </div>
			<div class="adressUpdate profileBox">
                <h2>Address</h2>
                <form>
					<ul>
						<li class="clearfix">
							<label>
								<span class="leftWrap">Name</span>
								<span class="rightWrap"><input type="text" accept="text/plain" name="profile_username" class="nameUser" value="<?php echo isset($curl_get_user_profile->userAddress->name)  ? $curl_get_user_profile->userAddress->name : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_FULLNAME_PLACEHOLDER'];?>"/>
              </span>
							</label>
						</li>
						<li class="clearfix">
							<label>
								<span class="leftWrap">Mobile</span>
								<span class="rightWrap"><input type="number" accept="text/plain"  name="profile_mobilenumber" class="numberUser" value="<?php echo isset($curl_get_user_profile->userAddress->mobileNumber)  ? $curl_get_user_profile->userAddress->mobileNumber : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_MOBILE_NUMBER'];?>" id="profile_mobilenumber" maxlength="10" />
			</span>
							</label>
						</li>
					
						<!--<li class="clearfix">
							<label>
								<span class="leftWrap">Email</span>
								<span class="rightWrap"><input type="hidden" accept="text/plain"  name="profile_useremail" class="numberUser" value="<?php echo $this->session->userdata('LoginEmail');?>" />
				</span>
							</label>
						</li>-->
						<li class="clearfix">
							<label>
								<span class="leftWrap">House No.</span>
								<span class="rightWrap"><input type="text" accept="text/plain"  name="house_flatno" class="numberUser" value="<?php echo isset($curl_get_user_profile->userAddress->houseNumber)  ? $curl_get_user_profile->userAddress->houseNumber : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_HOUSE_FLAT'];?>" id="house_flatno" />
								</span>
							</label>
						</li>
						<li class="clearfix">
							<label>
								<span class="leftWrap">Street</span>
								<span class="rightWrap"><input type="text" accept="text/plain"  name="street_loc" class="numberUser" value="<?php echo isset($curl_get_user_profile->userAddress->street)  ? $curl_get_user_profile->userAddress->street : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_STREET_LOCALITY'];?>" id="street_loc" />
								</span>
							</label>
						</li>
						<li class="clearfix">
							<label>
								<span class="leftWrap">Pin</span>
								<span class="rightWrap"><input type="number" name="pincode" class="numberUser pincode_m" value="<?php echo isset($curl_get_user_profile->userAddress->pincode)  ? $curl_get_user_profile->userAddress->pincode : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_PINCODE'];?>" id="pincode" />
							</span>
							</label>
						</li>
							<li class="clearfix">
							<label>
								<span class="leftWrap">City</span>
								<span class="rightWrap"><input type="text" accept="text/plain"  name="city_district" class="numberUser" value="<?php echo isset($curl_get_user_profile->userAddress->city)  ? $curl_get_user_profile->userAddress->city : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_CITY_DISTRICT'];?>" id="city_district" />
				</span>
							</label>
						</li>
								<li class="clearfix">
							<label>
								<span class="leftWrap">State</span>
								<span class="rightWrap"><input type="text" accept="text/plain"  name="state" class="numberUser" value="<?php echo isset($curl_get_user_profile->userAddress->state)  ? $curl_get_user_profile->userAddress->state : '';?>"  placeholder="<?php echo $retrieveconstant['TEXT_STATE'];?>" id="state" />
				</span>
							</label>
						</li>
						
					
						<li class="clearfix">
							<button class="btnDefault" onclick="updateuserprofile()">Done</button>
						</li>
					</ul>
				</form>
            </div>
            <div class="totalSitycash profileBox">
                <h2><?php echo $retrieveconstant['TEXT_SITYCASH_BALANCE'];?></h2>
                <p class="headinfo"><?php 
				if($curl_get_shopsitycash->Data!=null)
				{
					echo str_replace('XXXX',$curl_get_shopsitycash->Data->Balance,$retrieveconstant['TEXT_TOTAL_SHOW_SITYCASH_BALANCE']);
				} else
				{
					echo str_replace('XXXX',0,$retrieveconstant['TEXT_TOTAL_SHOW_SITYCASH_BALANCE']);
				}
				
				?> </p>
            </div>
            
              <div class="helpCenter profileBox displayNone">
                <h2><?php echo $retrieveconstant['TEXT_HELP_CENTER'];?></h2>
                <p class="subHeadInfo"><?php echo $retrieveconstant['TEXT_ASSISTANCE'];?> <span>></span></p>
            </div>
             <div class="feedback profileBox displayNone">
                <h2><?php echo $retrieveconstant['TEXT_FEEDBACK'];?> </h2>
                <p class="subHeadInfo"><?php echo $retrieveconstant['TEXT_REPORT_BUG_FEEDBACK'];?> <span>&gt;</span></p>
            </div>
        </section>
        <div class="settingBox">
        <section class="accountSetting displayNone">
            <?php echo $retrieveconstant['TEXT_ACCOUNT_SETTING'];?>
        </section>
        <section class="logout txtCenter">
              <?php echo '<a href="'.base_url().'logout"  >'  .$retrieveconstant['TEXT_LOGOUT'].'</a>';?>
        </section>
            </div>
    