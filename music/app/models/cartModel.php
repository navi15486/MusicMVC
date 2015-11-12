<?php
require_once '../app/core/database.php'; 

class cartModel
{
	private $audio_id;
	private $profile_id;
	private $shopping_line_id;

	public function getAudioId()
	{
		return $this->audio_id;
	}

	public function getProfileId()
	{
		return $this->profile_id;
	}

	public function getLineId()
	{
		return $this->shopping_line_id;
	}

	public function addCart( $audio_id  , $profile_id )
	{
		$connection = new pdoconn();   
		$data = array("$audio_id",   "$profile_id" );
		$STH = $connection->DBH->prepare("INSERT INTO shopping_cart_line ( audio_id ,   profile_id) VALUES (?,  ?)");
		$this->profile_id = $profile_id;
		$this->audio_id = $audio_id;
		return  $STH->execute($data);	 
	}

	public function deleteCart($cart_id)
	{
		$connection = new pdoconn();   
		$data = array("$cart_id"  );
		$STH = $connection->DBH->prepare("DELETE FROM shopping_cart_line WHERE shopping_line_id = ?");
		return  ($STH->execute($data));
	}

	public function searchCookie($cookie_id)
	{
		$connection = new pdoconn();   
		$data = array("$cookie_id"  );
		$STH = $connection->DBH->prepare("SELECT FROM shopping_cart WHERE $cookie_id = ?");
		$STH->execute($data);
		if($row = $STH->fetch())
	      return true;
		return false;
	}

	public function countCart($profile_id)
	{
		$connection = new pdoconn();   
		$data = array("$profile_id" );
		$STH = $connection->DBH->prepare("SELECT * FROM shopping_cart_line WHERE profile_id = ?");
	    $STH->execute($data);
	    return $STH->rowCount();
	}

	public function updateCart($cart_id , $profile_id , $audio_id )
	{
		$connection = new pdoconn();   
		$data = array( "$audio_id" ,"$profile_id"  , "$cart_id" );
		$STH = $connection->DBH->prepare("UPDATE shopping_cart_line SET audio_id =? , profile_id = ?    WHERE shopping_line_id = ?");
	   	return $STH->execute($data); 
	}

	public function getCart($profile_id)
	{
		$connection = new pdoconn();   
		$data = array("$profile_id" );
		$STH = $connection->DBH->prepare("SELECT * FROM shopping_cart_line WHERE profile_id = ?");
	    $STH->execute($data);
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		$carts = [];
		foreach ($rows as $row)
	    {
			$cart = new cartModel;
			$cart->profile_id = $row['profile_id']; 
		 	$cart->audio_id = $row['audio_id']; 
			$cart->shopping_line_id = $row['shopping_line_id'];
		    $carts[] = $cart; 
		}
		return $carts;
	} 

	//get all the items in the cart for admin
	public function getCarts()
	{
		$connection = new pdoconn();    
		$STH = $connection->DBH->prepare("SELECT * FROM shopping_cart_line  ");
	    $STH->execute();
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		$carts = [];
		foreach ($rows as $row)
		{
			$cart = new cartModel;
			$cart->profile_id = $row['profile_id']; 
		 	$cart->audio_id = $row['audio_id']; 
			$cart->shopping_line_id = $row['shopping_line_id'];
		    $carts[] = $cart; 
		}
		return $carts;
	}
}