<?php
	require_once("XML/RPC.php");
	
	$client=new XML_RPC_Client("/server.php","http://demoservice");
	
	//$client->setDebug(1);
	
	echo "<xmp>";
	
	$resp=$client->send(
		new XML_RPC_Message("demoservice::helloservice_2",
			Array(
				XML_RPC_encode(
					Array(
						"name"=>"Kolya",
						"age"=>2,
						"skills"=>Array("C++","C#","Pascal")
					)
				)
			)
		)
	);
	
	if(!$resp) {
		die("Ошибка передачи запроса");	
	}elseif($resp->faultCode()!=0) {
		die("Ошибка сервиса".$resp->faultCode()." ".$resp->faultString());
	}
	
	var_dump($resp->value);echo "</xmp>";
	
	echo $resp->value()->scalarval();