<?php
require_once '../app/core/database.php';

class ordersModel
{
	private $order_id;
	private $profile_id;
	private $order_date;
	private $order_methpmt;

	public function add($profileID, $order_date, $order_mthpmt)
	{
		$this->profile_id = $profileID;
		$this->order_date = $order_date;
		$this->order_methpmt = $order_mthpmt;
		$connection = new pdoconn();
		$data = array("$this->profile_id", "$this->order_date", "$this->order_methpmt");
		$STH = $connection->DBH->prepare("INSERT INTO orders (profile_id, order_date, order_methpmt) VALUES (?, ?, ?)");
		$STH->execute($data);
		return $connection->DBH->lastInsertId();
	}

	public function getOrders()
	{
		$connection = new pdoconn(); 
		$STH = $connection->DBH->query("SELECT * FROM orders");
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$orders_array = [];
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
		{
		$order = new audioModel();
		$order->orders_id = $row['orders_id'];
		$order->profile_id = $row['profile_id'];
		$order->order_date = $row['order_date'];
		$order->order_methpmt = $row['order_methpmt']; 
		$orders_array[] = $order;
		}
		return $audio_array;
	}
}