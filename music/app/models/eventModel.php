<?php

require_once '../app/core/database.php';

/*** imageModel class handles queries related to image table in the database ***/
class eventModel
{
	private $eventId;
	private $description;
	private $eventDate;
	private $userId;
	private $eventName;
 
	public function getName()
	{
		return $this->eventName;
	}
	public function getEventId()
	{
		return $this->eventId;
	}

	public function getDescription() 
	{
		return $this->description;
	}

	public function getEventDate()
	{
		return $this->eventDate;
	}

	public function addEvent($eventName, $description , $userId)
	{
		$connection = new pdoconn(); 
		$data = array("$eventName", "$description" ,  "$userId");
		$STH = $connection->DBH->prepare("INSERT INTO events (event_name, description , user_id) VALUES (?, ?, ? )");
		return $STH->execute($data);
	}

	public function updateEvent($eventName, $description, $event_id)
	{
		$connection = new pdoconn(); 
		$data = array("$eventName", "$description" , "$event_id");
		$STH = $connection->DBH->prepare("UPDATE events set event_name = ? , description = ?  where event_id = ?");
		return $STH->execute($data);
	}

	public function deleteEvent($eventId)
	{
		$connection = new pdoconn(); 
		$data = array("$eventId");
		$STH = $connection->DBH->prepare("DELETE FROM events WHERE event_id = ?");
		return $STH->execute($data);
	}

	public function showEvent()
	{
		$connection = new pdoconn(); 
		$STH = $connection->DBH->prepare("SELECT * FROM events");
	    $STH->execute();
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		$events = [];

		foreach ($rows as $row) 
		{
			$event = new eventModel;
			$event->eventId = $row['event_id'];
			$event->description = $row['description'];
			$event->eventName = $row['event_name'];
			$events[] = $event;
		}
		return $events;
	}
}