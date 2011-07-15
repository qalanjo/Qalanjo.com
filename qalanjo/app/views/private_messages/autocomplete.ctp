<?php
$i=0;
foreach($messages as $message){ //loop over the searched members
	$response[$i]["value"] = $message["PrivateMessage"]["title"].";".$message["PrivateMessage"]["id"];
	$response[$i]["label"]	=$message["PrivateMessage"]["title"];
	$i++;
}
echo json_encode($response);