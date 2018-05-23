<?php 
	//http://lite.ip2location.com/database-ip-country-region-city-latitude-longitude-zipcode-timezone
	$dottedFormatAddress = '116.212.244.94'; 
	$ipv4address = sprintf("%u", ip2long($dottedFormatAddress)); 
	echo $ipv4address;
?> 