<!--    NAVIGATION MENU START-->
    <div class="bodyMask" id="leftMenu">
        <nav class="leftMenu genericMenu">
<?php 
foreach($layout_file['header']['topmenu']['innerpage'] as $key=>$val)
{
	
	  $this->load->view('uidesign/'.$val['ui'].'.php');
}

?>
        </nav>
    </div>
  <!--    NAVIGATION MENU END-->  
    <header>
        <div class="headerWrap">
            <div class="allIcon menuIcon"></div>
           <a href="<?php echo base_url();?>"> <div class="allIcon logoIcon"></div></a>
            <a href="<?php echo base_url().'notification';?>"><div class="allIcon discountIcon"></div></a>
             <a href="<?php echo base_url().'order';?>"><div class="allIcon bagIcon"></div></a>
        </div>
    </header>
	