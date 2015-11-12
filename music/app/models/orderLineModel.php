<?php
require_once '../app/core/database.php';

class orderLineModel
{
	private $order_line_id;
	private $order_id;
	private $audio_name;
	private $audio_genre;
	private $audioIsSong;
	private $audioIsInstrumental;
	private $audio_type;
	private $price;

	public function add($orderID, $audioName, $audioGenre, $audioIsSong, $audioIsInstrumental, $audioType, $audioPrice)
	{
		$this->order_id = $orderID;
		$this->audio_name = $audioName;
		$this->audio_genre = $audioGenre;
		$this->audioIsSong = $audioIsSong;
		$this->audioIsInstrumental = $audioIsInstrumental;
		$this->audio_type = $audioType;
		$this->price = $audioPrice;
		$connection = new pdoconn();
		$data = array("$this->order_id", "$this->audio_name", "$this->audio_genre", "$this->audioIsSong", "$this->audioIsInstrumental", "$this->audio_type", "$this->price");
		$STH = $connection->DBH->prepare("INSERT INTO order_lines (order_id, audio_name, genre, song, instrumental, audio_type, price) values (?, ?, ?, ?, ?, ?, ?)");
		$STH->execute($data);
	}
}
	 