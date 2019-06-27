<?php
// echo $this->uri->segment(2);
// echo $this->uri->segment(3);
// echo $this->uri->segment(4);

?>
<!--<script src="http://maps.googleapis.com/maps/api/js"></script>-->
<script>

function initialize() {
		var myCenter=new google.maps.LatLng('<?php echo $_POST['latitude'];?>','<?php echo $_POST['longitude'];?>');
					var mapProp = {
					  center:myCenter,
					  zoom:15,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
					  };
					var map=new google.maps.Map($("#googleMap")[0],mapProp);
					var marker=new google.maps.Marker({
					  position:myCenter
					  });
					marker.setMap(map);
					var infowindow = new google.maps.InfoWindow({
					  content:'<?php echo $_POST['storename'];?>'
					  });
					infowindow.open(map,marker);
					
  //var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
function loadScript() {
            var script = document.createElement("script");
                script.type = "text/javascript";
                script.src = "http://maps.google.com/maps/api/js?callback=initialize";
                document.body.appendChild(script);
							}

$(document).ready(function(){
loadScript();	
});

//google.maps.event.addDomListener(window, 'load', initialize);
</script>
		<h2><?php echo $_POST['storename'];?><button class="btnDefault cancelBtn closeMe">Back</button></h2>
       
         <div id="googleMap" style="width:100%;min-height:600px;height: 100%;"></div>
       
