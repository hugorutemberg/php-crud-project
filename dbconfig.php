<?php

	$DB_HOST = 'testdbhg.mysql.dbaas.com.br';
	$DB_USER = 'testdbhg';
	$DB_PASS = 'hugo153020';
	$DB_NAME = 'testdbhg';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
