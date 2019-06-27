<div class="downloadApp">
<?php
preg_match("/iPhone|Android|iPad|iPod|webOS/", $_SERVER['HTTP_USER_AGENT'], $matches);
$os = current($matches);
if($os=='iPhone' || $os=='iPad' || $os=='iPod')
{
	  echo $retrieveconstant['DOWNLOAD_SHOPSITY_APP_LINK_OTHER'];
} else
{
	 echo $retrieveconstant['DOWNLOAD_SHOPSITY_APP_LINK_ANDROID'];
}

?>
         
        </div>
