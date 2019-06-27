 	<input type="hidden" name="base_url" value="<?php echo base_url();?>"/>
	<input type="hidden" name="dotnetapipath" value="<?php echo DOTNET_API_PATH;?>"/>
	<input type="hidden" name="javaapipath" value="<?php echo JAVA_API_PATH;?>"/>
<a href="#" class="mainOptions borderBottom borderTop"><?php echo $retrieveconstant['HEADING_HEADER_PROFILE_MENU'];?></a>
            <div class="profileOptions">
                <ul>
				
				<?php 
		if(sizeof($retrieveconstant['PROFILE_LINK'])>0)
		{
			foreach($retrieveconstant['PROFILE_LINK'] as $key=>$val)
			{
					if(!isset($_SESSION['LoginEmail']) && ($key=='login_link' || $key=='help_link'))
				{
						if($val['url_redirect_controller']=='#')
				{
					echo '<li><a title='.$val['url_title'].' href="javascript:void(0);" >'.$val['url_heading'].'</a></li>';	
				} else {
					echo '<li>'.anchor($val['url_redirect_controller'], $val['url_heading'], 'title='.$val['url_title']).'</li>';
				}
					// echo '<li>'.anchor($val['url_redirect_controller'], $val['url_heading'], 'title='.$val['url_title']).'</li>';
					
				} else if(isset($_SESSION['LoginEmail']) && $key!='login_link')
				{
						if($val['url_redirect_controller']=='#')
				{
					echo '<li><a title='.$val['url_title'].' href="javascript:void(0);" >'.$val['url_heading'].'</a></li>';	
				} else {
					echo '<li>'.anchor($val['url_redirect_controller'], $val['url_heading'], 'title='.$val['url_title']).'</li>';
				}
				
				}
			}
		}
	
			?>    
                </ul>
            </div>
		