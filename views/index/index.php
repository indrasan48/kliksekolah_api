<?php
try{
	glfn::_xml_http_request();
	$arrayfields = $_POST;
	$data_json = $arrayfields;
	$url = URL.$_POST['method']."/".$_POST['function'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$return  = curl_exec($ch);	
	curl_close($ch);	
}catch(Exception $err){
	$return = $err;
}
echo $return;
?>