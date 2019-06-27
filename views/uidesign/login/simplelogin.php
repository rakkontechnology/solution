<section class="loginFormWrap">
	<div class="shopsityBg">
	    <b class="allIcon logoIconBig"></b>
		<p>Signup Via</p>
		
	</div>
            <form class="actionForm displayNone" name="loginform" id="loginform">
                <ul>
                    <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_EMAIL'];?></p>
						<?php	echo form_input(array('name'=>'email_mob','value'=>'')); ?>
                          
                        </label>
                    </li>
                     <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_PASSWORD'];?></p>
							<?php	echo form_password(array('name'=>'user_pass','value'=>'')); ?>
                          
                        </label>
                    </li>
                     <li class="passBox">
                        <label>
                           <!-- <span class="chkBox"></span>-->
							<input type="checkbox" name="show_password" class="chkBox"/>
                            <span><?php echo $retrieveconstant['TEXT_SHOW_PASSWORD'];?></span>
                        </label>
						<?php echo anchor($retrieveconstant['TEXT_FORGOT_PASSWORD']['url_redirect_controller'], $retrieveconstant['TEXT_FORGOT_PASSWORD']['url_heading'], 'title='.$retrieveconstant['TEXT_FORGOT_PASSWORD']['url_title'].''); ?>
                        
                    </li>
                    <li>
					
					<?php echo form_button($retrieveconstant['TEXT_LOGIN_BUTTON']['button_name'],$retrieveconstant['TEXT_LOGIN_BUTTON']['heading'],$retrieveconstant['TEXT_LOGIN_BUTTON']['para']);?>
                    </li>
                </ul>
                
            </form>
            
           <?php 	 $this->load->view('uidesign/loginfbgoogle/simplebutton.php'); ?>
        </section>
  