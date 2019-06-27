<?php
	$totaljs=$layout_file['js'];
	
	// echo "<pre>";
	// print_r($totaljs['template_file']);
	// exit;
	foreach($totaljs['template_file'] as $key=>$val)
{
	$returnjsdata=$val;
	// if(isset($this->city) && $returnjsdata=='locationpopup')
	// {
		// continue;
	// }
	
	
switch($returnjsdata)
{
	case 'homebanner':
	echo '$(document).ready(function () {
            $("#hBanners").owlCarousel({
                autoPlay:true,
				itemsCustom : true,
                singleItem : true,
                lazyLoad:true,
                navigation: true,
                stopOnHover : true,
                pagination : false,
                lazyEffect : "fade",
                navigationText: [
                  "<i class=icon-chevron-left icon-white><</i>",
                  "<i class=icon-chevron-right icon-white>></i>"
                ],
            });	
			var count = $(".catOptions li").length;
			if ($(count % 2 == 1)) {
			$(".catOptions").addClass("oddChild");
			}
			});';
	break;
	case 'hotdeals':
	echo '$(document).ready(function () {
             $("#dodBanners").owlCarousel({
                //autoPlay:true,
                lazyLoad:true,
                stopOnHover : true,
                 pagination : false,
                itemsMobile: [480,2],
                 itemsTablet: [768,4],		
                responsiveBaseWidth: window,
          });		
			});';
	
	break;
	case 'locationpopup':
	echo '
	function locationpopup()
	{  $("#locationPopUp").slideDown(500);    
        $(".closeMe").click(function(){
            $("#locationPopUp").slideUp(500);
        });  
         $(".commonRadioBtn .options").click(function(){
                $(".radioBox").removeClass("checked");
                $(this).find(".radioBox").addClass("checked");
	});
	}

	
	
	';
	
	break;
	case 'productsbanner':
	echo '$(document).ready(function () {
           $("#hBanners").owlCarousel({
                itemsCustom : true,
                singleItem : true,
                items:1,
                lazyLoad:true,
                navigation: true,
                stopOnHover : true,
                lazyEffect : "fade",
                
            });
			});';
			
			   
	
	break;
	case 'topmenu':
	echo '$(document).ready(function () {
		 $("#leftMenu").click(function(){
          $(this).hide(200);  
        }); 
        $(".menuIcon").click(function(){
            $("#leftMenu").show(200); 
        });
		});';
	
	break;
	case 'categoryaccordian':
	echo '$(document).ready(function () { 
		$(".openMe").click(function(){
if($(this).attr("id")=="hide")
{
	$(".openMe").removeClass("active");   
	$(this).addClass("active");
	this.id="show";
} else if($(this).attr("id")=="show")
{
	$(".openMe").removeClass("active");  
	this.id="hide";	
}	     });
			});';
			break;
	default:
	exit;
	
}
	
}


?>