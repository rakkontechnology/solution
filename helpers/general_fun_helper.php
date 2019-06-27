<?php
/*
Its a general function file developed by shopsity.



*/

if ( ! function_exists('retrun_location_ip'))
{
	/**
	 * Heading
	 *
	 * Generates an HTML heading tag.
	 *
	 * @param	string	content
	 * @param	int	heading level
	 * @param	string
	 * @return	string
	 */
	function retrun_location_ip($ip='')
	{
		($ip='' ? $ip=$_SERVER['REMOTE_ADDR'] : $ip=$ip);
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		return $details; 
	}
}	


if ( ! function_exists('getClientIP'))
{
function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}
}

//function for add page constant 
if ( ! function_exists('GetAllPageConstant'))
{
function GetAllPageConstant($pagename) {
	$ci=& get_instance();
	foreach($ci->config->item($pagename)['pages_constant'] as $key=>$val)
		{
			$ci->load->config(PAGE_CONSTANT_PATH.$val);
			$ci->data['retrieveconstant']=array_merge($ci->data['retrieveconstant'],$ci->config->item($val) );
		}

}
}

//function for add page constant Sorting
if ( ! function_exists('GetAllPageConstantSort'))
{
function GetAllPageConstantSort($pagename) {
	$ci=& get_instance();
	foreach($ci->config->item($pagename)['sort_array_constant'] as $key=>$val)
		{
			$ci->data['retrieveconstant']=array_merge($ci->data['retrieveconstant'],sort_array_asc($ci->config->item($val['pagename'])[$val['stored_variable_name']],$val['stored_variable_name']));
		}
		}

}


//function for add page constant Sorting
if ( ! function_exists('AddMultiCurl'))
{
function AddMultiCurl($allurl) {
	$ci=& get_instance();
	$add_var='';
	foreach($allurl as $key=>$val)
		{
			//print_R($val['send_variable']);
			// echo $val['stored_var_name'];
			$ci->mcurl->add_call($val['stored_var_name'],$val['method'],$val['prefix_url'].$val['sufix_url'],$val['send_variable'],$val['options']);
			
		}
		}

}

//function for find in multidimensional array
if ( ! function_exists('SearchMultidimArray'))
{
function SearchMultidimArray($value, $key, $array) {
   foreach ($array as $k => $val) {
       if ($val[$key] == $value) {
           return $k;
       }
   }
   return null;
}
}


//function for find in replaceallspecial character by highfen array
if ( ! function_exists('ReplaceSpecialHyphen'))
{
function ReplaceSpecialHyphen($string) {
	$string=preg_replace("/[%#$&)(]/", "", $string);
	//$string=str_replace(' ','-',$string);
	return $string;
}
}

//function for find in multidimensional array
if ( ! function_exists('SearchLocationExist'))
{
function SearchLocationExist($value, $key) {
	$array=GetAllLocation();
   foreach ($array as $k => $val) {
       if ($val[$key] == $value) {
           return true;
       }
   }
   return false;
}
}


// replace recursive
if ( ! function_exists('ReplaceRecursive'))
{
function ReplaceRecursive(Array $array, $key, $value)
{
    array_walk_recursive($array, function(&$v, $k) use ($key, $value)
        {$k == $key && $v = $value;});
    return $array;
}
}


// replace recursive
if ( ! function_exists('ReplacementParameter'))
{
function ReplacementParameter($mainarray,$replacementarray)
{
	$output=array();
  foreach($replacementarray as $key=>$val)
  {
	 $output[$key]= ReplaceRecursive($mainarray[$key],$val['key'],$val['replace_val']);  
	  
  }
	  return  array_merge($mainarray,$output);
  
}
}

//cut the title by length
function substrwords($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return trim($output);
}



// for replace latidute and longidute
if ( ! function_exists('ReplaceLongiAndLatidute'))
{
function ReplaceLongiAndLatidute($zonename, $pagearray)
{
	$key='Zone';
	$zonename=ucwords(strtolower($zonename));
	
	$locationarray=GetAllLocation();
	$locationkey=SearchMultidimArray($zonename,$key,$locationarray);

	$Latidute=$locationarray[$locationkey]['Latidute'];
	$output=ReplaceRecursive($pagearray, 'Latidute', $Latidute);
	$Longitude=$locationarray[$locationkey]['Longitude'];
	$output=ReplaceRecursive($output, 'Longitude', $Longitude);
	$output=array_str_replace('{LONGITUDE}',$Longitude, $output);
	$output=array_str_replace('{LATIDUTE}', $Latidute, $output);
	// echo "<pre>";
	// print_r($output);
	// exit;
	
	
	return $output;
}
}


// for replace latidute and longidute
if ( ! function_exists('ReplaceLocation'))
{
function ReplaceLocation($zonename, $pagearray)
{
	$key='Zone';
	
	$zonename=ucwords(strtolower($zonename));
	
	$locationarray=GetAllLocation();
	$locationkey=SearchMultidimArray($zonename,$key,$locationarray);

	$Latidute=$locationarray[$locationkey]['Latidute'];
	
	$output=ReplaceRecursive($pagearray, 'Latidute', $Latidute);
	$Longitude=$locationarray[$locationkey]['Longitude'];
	$output=ReplaceRecursive($output, 'Longitude', $Longitude);
	$output=array_str_replace('{LONGITUDE}',$Longitude, $output);
	$output=array_str_replace('{LATIDUTE}', $Latidute, $output);
	$cityname=Cityreplacecharacter($zonename);;
	$output=array_str_replace('{LOCATION}',$cityname, $output);
	//$output=array_str_replace('{LOCATION}','Lajpat Nagar South Delhi', $output);
	
	// echo "<pre>";
	// print_r($output);
	// exit;
	
	
	return $output;
}
}


if(!function_exists('GetLatLong'))
{
function GetLatLong($zonename)
{
	$key='Zone';
	
	$zonename=ucwords(strtolower($zonename));
	
	$locationarray=GetAllLocation();
	$locationkey=SearchMultidimArray($zonename,$key,$locationarray);

	$Latidute=$locationarray[$locationkey]['Latidute'];
	$Longitude=$locationarray[$locationkey]['Longitude'];
	$output[]=$Latidute;
	$output[]=$Longitude;
	
	
	return $output;
}
}

// for City replace character
if ( ! function_exists('Cityreplacecharacter'))
{
function Cityreplacecharacter($cityname)
{
	return str_replace(' ','_',$cityname);
}

}

// for City replace character
if ( ! function_exists('CityReplaceRevertCity'))
{
function CityReplaceRevertCity($cityname)
{
	return str_replace('_',' ',$cityname);
}

}


if ( ! function_exists('get_full_url'))
{
function get_full_url()
{
   $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return $pageURL;
}
}


/*
// for replace latidute and longidute in suffix
if ( ! function_exists('ReplaceLongiAndLatiduteSufix'))
{
function ReplaceLongiAndLatiduteSufix($zonename, $pagearray)
{
	$key='Zone';
	$locationarray=GetAllLocation();
	$locationkey=SearchMultidimArray($zonename,$key,$locationarray);
	$Latidute=$locationarray[$locationkey]['Latidute'];
	$output=array_str_replace('{LATIDUTE}', '1111111', $pagearray);
	$Longitude=$locationarray[$locationkey]['Longitude'];
	$output=array_str_replace('{LONGITUDE}', '22222222', $pagearray);
	return $output;
}
}
*/
// for replace lsring
if ( ! function_exists('array_str_replace'))
{
function array_str_replace( $sSearch, $sReplace, $aSubject) {
	foreach( $aSubject as $sKey => $value ) {
		   if(is_array($value) ) {
			   
			   foreach( $value as $sKey2 => $value2 ) {
				  
				 if(is_array($value2) ) {
					 continue;
						/*foreach( $value2 as $sKey3 => $value3 ) 
						{
							 if(is_array($value2) ) {
						foreach( $value3 as $sKey4 => $value4 ) 
						{
							 if(is_array($value4) ) {
								 continue;
							 } else
							 {
							if( strpos($value4, $sSearch) !== false )
							{
						$aSubject[$sKey][$sKey2][$sKey3][$sKey4] = str_replace( $sSearch, $sReplace, $value4 );
							}
							 }
							
						}
							 } 	
								else
								{
							if( strpos($value3, $sSearch) !== false )
							{
						$aSubject[$sKey][$sKey2][$sKey3] = str_replace( $sSearch, $sReplace, $value3 );
							}
								}
						}*/
						
						} else
						{
						  // echo $value2;
						  // echo "<br>";
					
							if( strpos($value2, $sSearch) !== false )
							{
							
					   $aSubject[$sKey][$sKey2] = str_replace( $sSearch, $sReplace, $value2 );
					 
							}
						}
						
				   
			   }
			  
	
		   } else
		   {
			   if( strpos($value, $sSearch) !== false )
							{
			   $aSubject[$sKey] = str_replace( $sSearch, $sReplace, $value );
							}
		   }
		 
	}
	$aSubject;
   return $aSubject;
}
}

// for SanitizeString
if ( ! function_exists('SanitizeString'))
{
function SanitizeString ($string)
{
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);

    return $string;
}

}

// for SanitizeString
if ( ! function_exists('array_combine_diff_length'))
{
function array_combine_diff_length($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}
}

//function for the dateformat
function dateformatjson($jsonDate) 
{
date_default_timezone_set('Asia/Calcutta');
$date = new DateTime();
$offset = $date->getTimestamp()* 60000;
$parts = '/\/Date\((-?\d+)([+-]\d{2})?(\d{2})?.*/';
preg_match($parts, $jsonDate,$output);

	     if ($output[2] == null)
		 {
           $output[2] = 0;
		 }
			if ($output[3] == null)
			{
            $output[3] = 0;
			}

		$returnoutput=date('d-m-y',$output[1] +$offset+ $output[2]*3600000+$output[3]*60000);
	
	   return $returnoutput;
}


//function for removing empty array value 
if ( ! function_exists('remove_empty_array_value'))
{
function remove_empty_array_value($post_data) {
foreach( $post_data as $key => $value ) {
				if( is_array( $value ) ) {
					foreach( $value as $key2 => $value2 ) {
						if( empty( $value2 ) ) 
							unset( $post_data[ $key ][ $key2 ] );
					}
				}
				if( empty( $post_data[ $key ] ) )
					unset( $post_data[ $key ] );
				}
				return $post_data;
}
}


//import csv
if ( ! function_exists('csv_import_data'))
{
function csv_import_data($post_data='') {
	
$filename=SAVE_CSV_PATH."Shopsity";

$csv_filename = $filename."_".date("Y-m-d").".csv";

//header("Content-Type: application/vnd.ms-excel");

$fileContent="method,url,params,options,curl,status,error,totaltime,connect_time,response\n";

// echo "<pre>";
// print_r($post_data['sendparam']);
// exit;

$fileContentData= array($post_data['method'],$post_data['apiurl'],print_r($post_data['sendparam'], true),print_r($post_data['sendoption'], true),$post_data['curlstatus'],$post_data['status'],$post_data['error'],$post_data['totaltime'],$post_data['connect_time'],print_r($post_data['response'], true));

    

$fileContent=str_replace("\n\n","\n",$fileContent);
if(!file_exists($csv_filename))
{
$fd = fopen ($csv_filename, "w");
fputs($fd, $fileContent);
fputcsv($fd, $fileContentData);
} else
{
$fd = fopen($csv_filename, "a");
fputcsv($fd, $fileContentData);

}
 
   fclose($fd);
   
   //header("content-disposition: attachment;filename=$csv_filename");
}

	
}


// for All location
if ( ! function_exists('GetAllLocation'))
{
function GetAllLocation()
{
	$output=array(array("Id"=> 7,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.578900,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.243900,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "South Delhi"),
		array(
        "Id"=> 6,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.639995,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.220425,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Central Delhi"),
		array(
        "Id"=> 4,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.626455,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.296340,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "East Delhi"),
		array(
        "Id"=> 10,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.402535,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.319074,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Faridabad"),
		array(
        "Id"=> 11,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.699653,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.395028,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Ghaziabad"),
		array(
        "Id"=> 236,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.498359,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.515995,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Greater Noida"),
		array(
        "Id"=> 8,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.470000,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.030000,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Gurgaon"),
		array(
        "Id"=> 9,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.516753,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.398130,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "Noida"),
		array(
        "Id"=> 5,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.717469,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.211445,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "North Delhi"),
		array(
        "Id"=> 3,
        "Banners"=> null,
        "City"=> "Delhi\/NCR",
        "Country"=> "India",
        "Distance"=> null,
        "IsActive"=> true,
        "IsMall"=> false,
        "IsMetroCity"=> true,
        "Latidute"=> 28.654150,
        "Locality"=> null,
        "LocationImage"=> null,
        "LocationType"=> 3,
        "Longitude"=> 77.067359,
        "MetroCityPriority"=> 1,
        "ParentId"=> 2,
        "StateId"=> 29,
        "Zone"=> "West Delhi"));
	return $output;
}
}





