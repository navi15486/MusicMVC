<?php 
class pdoconn {
var $host = '127.0.0.1';
var $dbname = 'ms';
var $user = 'root';
var $pass = '';
var $myconn;
var $DBH;

public function __construct() 
{
	try {
			$this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
			$this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 
# Typed DELECT instead of SELECT!
		}catch(PDOException $e)
		
		{
			echo $e->getMessage();
		}
}


}