<?php
	require_once("XML/RPC/Server.php");
	require_once("XML/RPC.php");
	
	function HelloService($params) {
		$name=$params->getParam(0)->getval();
		$age=$params->getParam(1)->getval();
		$skills=XML_RPC_decode($params->getParam(2));
		
		if($age<18)
			$resp="Ты маленький, тебе сюда нельзя";
		else
			$resp="Добро пожаловать";
		
		$skill_rate="";
		if(count($skills)>0)
			$skill_rate=implode(",",$skills)." Вы очень образованный юзер.";
		
		
		return new XML_RPC_Response(new XML_RPC_Value("Hello, $name! $resp $skill_rate","string"));
	}
	
	function HelloService2($params) {
		global $XML_RPC_erruser;
		
		//die("TEST");
		
		$args=XML_RPC_decode($params->getParam(0));
		
		if($args["age"]<18)
			return new XML_RPC_Response(0,$XML_RPC_erruser+1,"Ты маленький, тебе сюда нельзя");
		/*else
			$resp="Добро пожаловать";*/
		
		$skill_rate="";
		if(count($args["skills"])>0)
			$skill_rate=implode(",",$args["skills"])." Вы очень образованный юзер.";
		
		
		return new XML_RPC_Response(new XML_RPC_Value("Hello, $args[name]! $resp $skill_rate","string"));
	}
	
	
	$map=Array(
		"demoservice::helloservice"=>Array(
			"function"=>"HelloService",
			"signature"=>Array(
				Array("string","string","int"),
				Array("string","string","int","array")
			),
			"docstring"=>"Всего лишь приветствие кого-нибудь"
		),
		"demoservice::helloservice_2"=>Array(
			"function"=>"HelloService2",
			"signature"=>Array(
				Array("string","struct")				
			)			
		)
	);
	
	$srv=new XML_RPC_Server($map,1,0);
	