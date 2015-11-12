<?php
require_once '../app/core/database.php'; 

class cookieModel
{
	private $cookie_id;
	private $cookie_expiration;
	public function setCookies($cookie_id)
	{
		$connection = new pdoconn();  
		$d=strtotime("+1 day");
		$expiration_date = date("Y-m-d h:i:sa", $d);
		$data = array( "$cookie_id" ,"$expiration_date" );
		$STH = $connection->DBH->prepare("INSERT INTO cookies ( cookie_id , cookie_expiration) VALUES (?, ?)");
		$this->cookie_id = $cookie_id; 
		$this->cookie_expiration = $expiration_date;
		$STH->execute($data);
		return $connection->DBH->lastInsertId();
	}
}