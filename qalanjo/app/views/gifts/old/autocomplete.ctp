<?php
$searches = array();
$i=0;
foreach($gifts as $gift){ //loop over the searched members
	$response[$i]["value"] = $gift["Gift"]["name"].";".$gift["Gift"]["id"];
	$img = $this->Html->image('gifts/'.$gift['Gift']['picture_path'],array('class'=>'picture_search','width'=>32));
	$response[$i]["label"]	= $img.$gift["Gift"]["name"];
	$i++;
}
echo json_encode($response);

