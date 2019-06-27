
	<?php 
	$totaljs=$layout_file['js'];
	
	// echo "<pre>";
	// print_r($totaljs);
	// exit;
	// $totaljsfile=$totaljs['file'];
	// unset($totaljsfile['app']);
		if($totaljs['file']!=null)
{
foreach($totaljs['file'] as $key=>$val)
{
	
		echo '<script src="'.base_url().JAVASCRIPT_PATH.$val.'.js?v='.RANDOM_VALUE_FOR_JS_CSS.'" type="text/javascript"></script>';
	
}
}
		if($totaljs['template_file']!=null)
{
if(count($totaljs['template_file'])>0)
{
	 
	echo '<script>';
	$this->load->view('templates/template_js.php'); 

	echo '</script>';
}
}

if(!isset($this->city))
{
		echo '<script>locationpopup();</script>';
}
?>
<?php
if($this->router->fetch_class()=='productslistings')
{
?>

<script>
$(document).ready(function(){
	var referrer =  document.referrer;
	function getresult(url,pagenumber_return,startIn) {
		var orgurl='<?php echo $url=str_replace(base_url(),'',get_full_url());?>';
		var listingpagesize='<?php echo DEFINE_LISTING_PAGE_SIZE;?>';
		$('#LoaderDiv').removeClass('displayNone');
		var paramDataProducts = {'orgurl':orgurl,'city':'<?php echo $this->uri->segment(1);?>','sort_id':'<?php echo (isset($_GET['sort_id']) ? $_GET['sort_id'] : '') ;?>','q':'<?php echo (isset($_GET['q']) ? $_GET['q'] : '') ;?>',pagenumber:pagenumber_return,startIn:startIn};
		App.communication.ENCODE_POST({
                        url: url,
                        data: paramDataProducts,
                        successCallback: function (data) {
							
						$('#LoaderDiv').addClass('displayNone');
							$("#pagenumber").text(pagenumber_return);
							$("#product_data_apend").append(data);	
							$("#startindex").text(parseInt(listingpagesize)+startIn);
							if($('#EndOfProducts').length>0)
							{
										//var oldUrl = setGetParameter('pagenumber',parseInt(pagenumber_return)-1,'');
										var oldUrl = setGetParameter('startIn',startIn-10,'');
										window.history.pushState('object', document.title, oldUrl);
										 $(window).bind('popstate', function(){
										  window.location.href = referrer;
										});
							} 
									
						},
						onCompleteCallBack: function () {
						},
						errorCallback: function (e) {
							console.log('error');
						}
						});
		
	}
	 
	//id productslidewrap
	
	$(window).scroll(function(){
		 var scroll = $(window).scrollTop();
                if (scroll >= 10) {
                    $("body").addClass("fixed");
                } else {
                    $("body").removeClass("fixed");
                }
		if ($(window).scrollTop() >= ($(document).height() - $(window).height())-1800){
			var lastPageNumber=parseInt($("#lastpagenum").text());
			var startIn=parseInt($("#startindex").text());
			if(lastPageNumber < parseInt($("#total-page").text()) && lastPageNumber<parseInt($("#pagenumber").text())) { 
				
				
				if($('#EndOfProducts').length>0)
				{
					return false;
				} else
				{
					var baseurl=$("input[name=base_url]").val();
				
					var replaceurl=$("#url").text();
				$("#lastpagenum").text(parseInt($("#pagenumber").text()));
				var pagenumber = parseInt($("#pagenumber").text()) + 1;
				var newUrl = setGetParameter('startIn',startIn,'');
					//window.history.pushState('object', document.title, newUrl);
					window.history.pushState('object', document.title, newUrl);
			
					 $(window).bind('popstate', function(){
					  window.location.href = referrer;
					  });
					 
				// history.replaceState('object', document.title, newUrl);
				getresult('<?php echo base_url().$cityname.'/getproductslisting'?>',pagenumber,startIn);
				}
			}
		}
	}); 
	
	
	
});


</script>
<?php }
?>

<script>
$(document).ready(function(){
$(".search_m").autocomplete({
          width: 300,
        max: 10,
        delay: 100,
        minLength: 2,
        autoFocus: true,
        cacheLength: 1,
        scroll: true,
        highlight: false,
        source: function(request, response) {
			// alert(request.term);
            $.ajax({
                url: "<?php echo DEFINE_SEARCH_PAGE_API_URL;?>"+request.term,
				type:"get",
				contentType: "application/json;charset=UTF-8",
                dataType: "json",
                data: { "query": request.term },
                  success: function( data) {
                     if (data.TransactionStatus.IsSuccess) {
						  var responda=data.Data;
						 var suggestions = $.map(responda, function (dataItem) {
                            return { value: dataItem };
                        });
						  response(suggestions);
					  }
                },
                error: function(jqXHR, textStatus, errorThrown){
                     console.log( textStatus);
                }

            });
        },
		select: function(event, ui) {
			event.preventDefault();
			// alert(ui.item.value);
			var valueret=ui.item.value;
			window.location.href='<?php echo base_url().str_replace(' ','_',get_cookie('shopsity_CityName')).'/product?q='?>'+valueret.toLowerCase();
			$(".search_m").val(valueret);
						
				
				}
        });
		
		
		//this code for order page push state 
		var orgvalue = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
		var referrer =  document.referrer;
		var refervalue = referrer.substring(referrer.lastIndexOf('/') + 1);
	
		if(orgvalue=='order' && refervalue=='checkout')
		{
			// alert('<?php echo $this->session->userdata('refferalurl') ?>');
			var orgurlpush='<?php echo $this->session->userdata('refferalurl') ?>';
				window.history.pushState('object', document.title,  window.location.href);
					 $(window).bind('popstate', function(){
					  window.location.href = orgurlpush;
					  });
		}
 });
 </script>
 
 <?php
if($this->router->fetch_class()=='userprofile')
{
?>
 <script>
 
// params: { pincode:123},
//picode transaction
$(document).ready(function(){
	var perdata=JSON.stringify({ "pincode": 1 });
	$("#pincode").autocomplete({
         width: 300,
        max: 10,
        delay: 100,
        minLength: 2,
        autoFocus: true,
        cacheLength: 1,
        scroll: true,
        highlight: false,
        source: function(request, response) {
			// alert(request.term);
            $.ajax({
                url: "<?php echo DEFINE_PINCODE_AUTOCOMPLETE_API;?>",
				type:"post",
				contentType: "application/json;charset=UTF-8",
                dataType: "json",
                data: JSON.stringify({ "pincode": request.term }),
                  success: function( data) {
                     if (data.successful) {
						  var responda=data.locations;
						 var suggestions = $.map(responda, function (dataItem) {
                            return { pin: dataItem.pincode,cty:dataItem.city,stat:dataItem.state };
                        });
						  var picodes=$.map( suggestions, function( outputdata) {   return outputdata.pin + ', '+outputdata.cty+', '+outputdata.stat; });
						  response(picodes);
					  }
                },
                error: function(jqXHR, textStatus, errorThrown){
                     console.log( textStatus);
                }

            });
        },
		select: function(event, ui) {
			event.preventDefault();
			var valueret=ui.item.value;
			var retarray = valueret.split(",");		
						$("#pincode").val(retarray[0]);
						$("#city_district").val(retarray[1]);
						$("#state").val(retarray[2]);
				
				
				}

		
        });
	
	
        });
		
</script>
<?php
}
?>
