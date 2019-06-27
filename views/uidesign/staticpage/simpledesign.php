              <section class="staticpage">
			 <?php		 
				$pagenameupper=strtoupper($pagedata);
			echo 	html_entity_decode($retrieveconstant['TEXT_HEADING_'.$pagenameupper]);
			 ?>
			  <?php  echo 	html_entity_decode($retrieveconstant['TEXT_DESC_'.$pagenameupper]);	 ?>		  
         
        </section>
  