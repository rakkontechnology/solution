            <section class="loginFormWrap">
            <form class="actionForm">
                <ul>
                    <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_MOBILE'];?></p>
							<?php	echo form_input(array('name'=>'mobile_number','value'=>'')); ?>
                           
                        </label>
                    </li>
                    <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_EMAIL'];?></p>
							<?php	echo form_input(array('name'=>'user_email','value'=>'')); ?>
                       
                        </label>
                    </li>
                     <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_PASSWORD'];?></p>
							<?php	echo form_password(array('name'=>'user_password','value'=>'')); ?>
                            
                        </label>
                    </li>
                    <li>
                        <label>
                            <p><?php echo $retrieveconstant['TEXT_PINCODE'];?></p>
                            <?php	echo form_input(array('name'=>'pincode','value'=>'')); ?>
                        </label>
                    </li>
                    <li class="commonRadioBtn clearfix">
                        <label class="options">
						<span class="radioBox checked"></span>
						<?php	echo form_radio('gender','',true,'class="radioBox checked"'); ?>
                            
                            <span><?php echo $retrieveconstant['TEXT_MALE'];?></span>
                        </label>
                         <label class="options">
                           <span class="radioBox checked"></span>
								<?php	echo form_radio('gender','','','class="radioBox checked"'); ?>
                            <span><?php echo $retrieveconstant['TEXT_FEMALE'];?></span>
                        </label>
                    </li>
                     <li class="passBox">
                        <label>
                            <span class="chkBox"></span>
									<?php	echo form_checkbox('showpassword','','','class="chkBox"'); ?>
                            <span><?php echo $retrieveconstant['TEXT_SHOW_PASSWORD'];?></span>
                        </label>
                         
                    </li>
                    <li>
					<?php echo form_button($retrieveconstant['TEXT_REGISTER_BUTTON']['button_name'],$retrieveconstant['TEXT_REGISTER_BUTTON']['heading'],$retrieveconstant['TEXT_REGISTER_BUTTON']['para']);?>
                       
                    </li>
                </ul>
                
            </form>
            
           <?php 	 $this->load->view('uidesign/loginfbgoogle/simplebutton.php'); ?>
        </section>