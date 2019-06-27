	<script>

//date funrionality
function dateconversion(jsonDate) {

        var offset = new Date().getTimezoneOffset() * 60000;

        var parts = /\/Date\((-?\d+)([+-]\d{2})?(\d{2})?.*/.exec(jsonDate);



        if (parts[2] == undefined)
		{

            parts[2] = 0;
		}



        if (parts[3] == undefined)
		{

            parts[3] = 0;
		}


        var date = new Date(+parts[1] + offset + parts[2]*3600000 + parts[3]*60000);
		var format = "DDD MMM-DD";

        return dateConvert(date,format);


}

// var date=new Date();

// document.write(dateConvert(date,format));

function dateConvert(dateobj,format){
  var year = dateobj.getFullYear();
  var month= ("0" + (dateobj.getMonth()+1)).slice(-2);
  var date = ("0" + dateobj.getDate()).slice(-2);
  var hours = ("0" + dateobj.getHours()).slice(-2);
  var minutes = ("0" + dateobj.getMinutes()).slice(-2);
  var seconds = ("0" + dateobj.getSeconds()).slice(-2);
  var day = dateobj.getDay();
  var months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
  var dates = ["SUN","MON","TUE","WED","THU","FRI","SAT"];
  var converted_date = "";

  switch(format){
    case "YYYY-MM-DD":
      converted_date = year + "-" + month + "-" + date;
      break;
    case "YYYY-MMM-DD DDD":
      converted_date = year + "-" + months[parseInt(month)-1] + "-" + date + " " + dates[parseInt(day)];
      break;
	  case "DDD MMM-DD":
	   converted_date =  dates[parseInt(day)] + " " + date +" " +months[parseInt(month)-1];
	  break;
	 
  }

  return converted_date;
}
	</script>
	<section class="notificationWrapper clearfix">
            <h2><?php echo $retrieveconstant['TEXT_NOTIFY_HEADING'];?></h2>
            <ul>
<?php 
 $pushnotify_curl_data=json_decode($mcurldata['pushnotify_curl']['response']);
 // echo "<pre>";
 // print_r($pushnotify_curl_data->Data);
 // exit;
 if($pushnotify_curl_data->Data!=null)
 {
 foreach($pushnotify_curl_data->Data as $key=>$val)
 {
	 
				$serachparamval=array_combine(explode(',',$val->SearchParamCommaSeperate),explode(',',$val->SearchValueCommaSeperate));
				$anchor_start='';
				$anchor_end='';
				if(array_key_exists(STORE_NAME_SERACH_PARAM,$serachparamval))
				{
				$anchor_start='<a href="'.base_url().strtolower(str_replace(' ','_',$cityname)).'/search?storename='.$serachparamval[STORE_NAME_SERACH_PARAM].'">'; 
				$anchor_end='</a>';
				}
				
				echo $anchor_start;
				?>
			
                <li>
                    <div class="noteHeader clearfix">
                        <div class="leftTemplate">
                            <b class="allIcon notificationIcon"></b>    
                        </div>
                        <div class="rightTemplate">
                            <p class="heading"><?php echo $val->Title;?></p>
                            <p class="noteDetails"><?php echo $val->Description;?></p>
                            <p class="noteTime"><script> document.write(dateconversion('<?php echo $val->CreatedDate; ?>')); </script></p>
                        </div>
                    </div>
						<?php
				if($val->ImageUrl!=null)
				{
						?>
                    <div class="noteImage clearfix">
                        <img src="<?php echo $val->ImageUrl;?>" alt="notification_image"/>    
                    </div>
					<?php
				}
					?>
                </li>
                
         
		<?php
			echo $anchor_end;
			
 } 
 }
 ?>
			
         </ul>
        </section>