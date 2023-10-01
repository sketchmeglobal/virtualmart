<?php 

$lat1 = '18.180555';
$lon1 = '-66.749961';
$lat2 = '18.455183';
$lon2 = '-67.119887';
$unit = 'km';

$theta = ($lon1 - $lon2);
$dist = sin(deg2rad((double)$lat1)) * sin(deg2rad((double)$lat2)) + cos(deg2rad((double)$lat1)) + cos(deg2rad((double)$lat2)) * cos(deg2rad((double)$theta));
print_r($dist);
$dist = acos($dist);
$dist = rad2deg($dist);
$distance = round($dist * 60 * 1.1515 * 1.609344);



 ?>