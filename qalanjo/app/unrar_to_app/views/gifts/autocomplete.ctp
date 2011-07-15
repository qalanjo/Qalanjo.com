<?php
$searches = array();
$i=0;
foreach($gifts as $gift){ //loop over the searched members
	$response[$i]["value"] = $gift["Gift"]["name"];
	$response[$i]["label"]	= $gift["Gift"]["name"];
	$i++;
}
echo json_encode($response);