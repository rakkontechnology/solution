       
			<?php 
			if(sizeof($retrieveconstant['TOTAL_FOOTER_LINK'])>0)
			{
				?>
				 <ul class="clearfix">
				 <?php
			foreach($retrieveconstant['TOTAL_FOOTER_LINK'] as $key=>$val)
			{
				if($val['url_redirect_controller']=='#')
				{
				echo '<li><a title='.$val['url_title'].' href="javascript:void(0)" >'.$val['url_heading'].'</a></li>';	
				} else
				{
				echo '<li>'.anchor($val['url_redirect_controller'], $val['url_heading'], 'title='.$val['url_title']).'</li>';
				}
				
			}
			?>
			 </ul>
			 <?php
			}
			?>           
       
  