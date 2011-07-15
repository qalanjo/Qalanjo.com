<?php
class DistanceCalculateComponent extends Object{

	function getDistance($lat1, $lat2, $long1, $long2){
		$radiusEarth = 6371;
		$lat = deg2rad($lat2 - $lat1);
		$lng = deg2rad($long2 - $long1);
		$a = pow(sin($lat/2), 2)+((cos(deg2rad($lat1))*cos(deg2rad($lat2)))*pow(sin($lng), 2));
		$c = 2 * atan2(sqrt($a), sqrt(abs($lng/2)));
		return ($radiusEarth * $c)/1.609344; 
	}
	
	
}