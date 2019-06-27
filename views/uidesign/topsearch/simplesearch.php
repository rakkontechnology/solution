 <section class="searchSite">
 
      
		 <?php	echo form_input('serach',(isset($_GET['q']) ? ucwords(str_replace('_',' ',$_GET['q'])) : ''),'placeholder="'.$retrieveconstant['TEXT_SEARCH_PLACEHOLDER']. '"  class="search_m"'); ?>
 </section>