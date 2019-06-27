	
	
	<h2><?php echo $retrieveconstant['TEXT_ORDER_CANCEL_REASON_HEADING'];?><span class="closeMe">X</span></h2>
	
  <section class="cancelOrderWrap">
  <input type="hidden" name="dotnetapipath" value="<?php echo DOTNET_API_PATH;?>"/>
	<input type="hidden" name="javaapipath" value="<?php echo JAVA_API_PATH;?>"/>
		<p id="reason_error" style="color:red"></p>
        <div class="predefinedReasons clearfix">
		<?php
		if(sizeof($layout_file['cancelorderreason']['reason'])>0)
		{
		foreach($layout_file['cancelorderreason']['reason'] as $key=>$val)
		{
			echo '<label><input type="radio" name="selected_reason" value="'.$val.'">  '.$val.'</label>';
			
		}
		} 
		?>
		</div>
		
          <button class="btnDefault cancelBtn"  href="javascript:void(0)" onClick="PermanentCancelOrder('<?php echo $_POST['order_id'];?>','<?php echo $this->session->userdata('LoginUserid');?>')"><?php echo $retrieveconstant['TEXT_ORDER_CANCEL_BUTTON'];?> </button>
		  <input type="hidden" name="reffer_url" value="<?php echo $reffer_url;?>" />
     
</section>

		