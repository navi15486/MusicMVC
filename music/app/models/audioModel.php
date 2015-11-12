<?php

require_once '../app/core/database.php'; 

class audioModel
{
	private $audio_id;
	private $audio_name;
	private $audio_genre;
	private $profile_id;
	private $audio_likes;
	private $audio_dislikes;
	private $file;
	private $song;
	private $instrumental;
	private $price;
	private $lyrics;
	private $audio_type;
	private $audio_size;
	private $cartId; 

	public function getCartId()
	{
		return $this->cartId;
	}
 	
 	public function setCartId($cartId)
 	{
 		$this->cartId =  $cartId;
 	}
	public function add($audioName, $genre, $audio, $size, $type, $song, $instrumental, $price ,  $profileId)
	{
		
		$this->audio_name = $audioName;
		$this->audio_genre = $genre;
		$this->file = $audio;
		$this->audio_type = $type; 
		$this->audio_size = $size;
		$this->profile_id = $profileId;
		$this->song = $song;
		$this->instrumental = $instrumental;
		$this->price = $price;
		$connection = new pdoconn();
		$data = array("$this->audio_name", "$this->audio_genre",  "$this->profile_id" , "$this->file", "$this->song" , "$this->instrumental" , "$this->price" , "$this->audio_type", "$this->audio_size");
		$STH = $connection->DBH->prepare("INSERT INTO audios (audio_name, genre, profile_id ,  file, song, instrumental , price, audio_type, audio_size) values (?, ?, ?, ?, ?, ?, ?,?,?)");
		return $STH->execute($data);
	}
 
	//Get all the audio files
	public function getAudios()
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->query("SELECT * FROM audios");
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$audio_array = [];
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row)
		{
			$audio = new audioModel();
			$audio->audio_id = $row['audio_id'];
			$audio->audio_name = $row['audio_name'];
			$audio->audio_genre = $row['genre'];
			$audio->profile_id = $row['profile_id'];
			$audio->audio_likes = $row['audio_likes'];
			$audio->audio_dislikes = $row['audio_dislikes'];
			$audio->file = $row['file'];
			$audio->song = $row['song'];
			$audio->instrumental = $row['instrumental'];
			$audio->price = $row['price'];
			$audio->lyrics = $row['lyrics'];
			$audio->audio_type = $row['audio_type'];
			$audio->audio_size = $row['audio_size'];
			$audio_array[] = $audio;
		}
		return $audio_array;
	}

	public function update($audioID, $audioName, $audio, $size, $type,$price)
	{
		$this->audio_id = $audioID;
		$this->audio_name = $audioName;
		$this->file = $audio;
		$this->audio_type = $type; 
		$this->audio_size = $size;
		$this->price = $price;
		$connection = new pdoconn();
		$data = array("$this->audio_name", "$this->file", "$this->audio_type", "$this->audio_size", "$this->price" , "$this->audio_id" , );
		$STH = $connection->DBH->prepare("UPDATE audios SET audio_name = ? , file = ?, audio_type = ?, audio_size = ? , price =? WHERE audio_id = ?");
		return $STH->execute($data);
	}

	public function delete($audioID)
	{
		$this->audio_id = $audioID;
		$connection = new pdoconn();
		$data = array("$this->audio_id");
		$STH = $connection->DBH->prepare("DELETE FROM audios WHERE audio_id = ?");	
		return $STH->execute($data);
	}
 
	public function getAudioID()
	{
		return $this->audio_id;
	}

	public function getAudioName()
	{
		return $this->audio_name;
	}

	public function getAudioGenre()
	{
		return $this->audio_genre;
	}

	public function getAudioFile()
	{
		return $this->file;
	}

	public function getIfSong()
	{
		return $this->song;
	}

	public function getIfInstrumental()
	{
		return $this->instrumental;
	}

	public function getAudioPrice()
	{
		return $this->price;
	}

	public function getAudioType()
	{
		return $this->audio_type;
	}

	public function getAudioSize()
	{
		return $this->audio_size;
	}

	public function getAudioLikes()
	{
		return $this->audio_likes;
	}

	public function getAudioDislikes()
	{
		return $this->audio_dislikes;
	}
	/********* User access methods********/
	//Get all the audio files of perticular Profile
	public function getAudiosById($profileId)
	{
		$connection = new pdoconn(); 
		$data = array("$profileId");
		$STH = $connection->DBH->prepare(" SELECT * FROM audios where profile_id = ? "); 
 		$STH->execute($data);
		$audio_array = [];
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC); 
		foreach ($rows as $row)
		{
			$audio = new audioModel();
			$audio->audio_id = $row['audio_id'];
			$audio->audio_name = $row['audio_name'];
			$audio->audio_genre = $row['genre'];
			$audio->profile_id = $row['profile_id'];
			$audio->audio_likes = $row['audio_likes'];
			$audio->audio_dislikes = $row['audio_dislikes'];
			$audio->file = $row['file'];
			$audio->song = $row['song'];
			$audio->instrumental = $row['instrumental'];
			$audio->price = $row['price'];
			$audio->lyrics = $row['lyrics'];
			$audio->audio_type = $row['audio_type'];
			$audio->audio_size = $row['audio_size'];
			$audio_array[] = $audio;
		}
		return $audio_array;
	}

	public function getCartAudios($audio_id)
	{
		$connection = new pdoconn(); 
		$data = array("$audio_id");
		$STH = $connection->DBH->prepare(" SELECT * FROM audios where audio_id = ? "); 
 		$STH->execute($data); 
		$audio = new audioModel();
		if($row = $STH->fetch())
		 {
			$audio->audio_id = $row['audio_id'];
			$audio->audio_name = $row['audio_name'];
			$audio->audio_genre = $row['genre'];
			$audio->profile_id = $row['profile_id'];
			$audio->audio_likes = $row['audio_likes'];
			$audio->audio_dislikes = $row['audio_dislikes'];
			$audio->file = $row['file'];
			$audio->song = $row['song']; 
			$audio->instrumental = $row['instrumental'];
			$audio->price = $row['price'];
			$audio->lyrics = $row['lyrics'];
			$audio->audio_type = $row['audio_type'];
			$audio->audio_size = $row['audio_size'];
			$audio_array[] = $audio;
		}
		return $audio;
	}

	 public function getByAudioId($audio_id)
	 {
		$allAudios = $this->getAudios();
		foreach ($allAudios as $row)
		{
			if ($row->getAudioID() == $audio_id) 	 
				return $row;
		 }
		return false;
	 }

	//Like the song
	public function audioLikes($audio_id)
	{ 
		$searchAudioRow = $this->getByAudioId($audio_id);
		if ($searchAudioRow)
		{
			$likes = 1;
			$likes += $searchAudioRow->getAudioLikes();
			$connection = new pdoconn(); 
			$data = array("$likes" ,"$audio_id");
			$STH = $connection->DBH->prepare("UPDATE audios set audio_likes = ? where audio_id = ? "); 
	 		return $STH->execute($data); 
		} 
	}

	//Dislike the songs
	public function audioDislikes($audio_id)
	{ 
		$searchAudioRow = $this->getByAudioId($audio_id);
		if ($searchAudioRow)
		{
			$dislikes = 1;
			$dislikes += $searchAudioRow->getAudioDislikes();
			$connection = new pdoconn(); 
			$data = array("$dislikes" ,"$audio_id");
			$STH = $connection->DBH->prepare("UPDATE audios set audio_dislikes = ? where audio_id = ? "); 
	 		return $STH->execute($data); 
		} 
	}


	//most popular song
	public function getPopularSongs()
	{
		$connection = new pdoconn();  
		$STH = $connection->DBH->prepare("SELECT * FROM audios ORDER BY audio_likes desc limit 5"); 
 		$STH->execute();
		$audio_array = [];
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);

		foreach ($rows as $row)
		{
			$audio = new audioModel();
			$audio->audio_id = $row['audio_id'];
			$audio->audio_name = $row['audio_name'];
			$audio->audio_genre = $row['genre'];
			$audio->profile_id = $row['profile_id'];
			$audio->audio_likes = $row['audio_likes'];
			$audio->audio_dislikes = $row['audio_dislikes'];
			$audio->file = $row['file'];
			$audio->song = $row['song'];
			$audio->instrumental = $row['instrumental'];
			$audio->price = $row['price'];
			$audio->lyrics = $row['lyrics'];
			$audio->audio_type = $row['audio_type'];
			$audio->audio_size = $row['audio_size'];

			$audio_array[] = $audio;
		}

		return $audio_array;
	}

	public function getPrice($audioID)
	{
		$this->audio_id = $audioID;
		$connection = new pdoconn();
		$data = array("$this->audio_id");
		$STH = $connection->DBH->prepare("SELECT * FROM audios WHERE audio_id = ?");
		$STH->execute($data);
		if($row = $STH->fetch())
		{
			return $row['price'];
		}			
	}

	public function updateAudio($audioID, $audioName, $audio, $size, $type, $price, $profileId)
	{
		$this->audio_id = $audioID;
		$this->audio_name = $audioName;
		$this->file = $audio;
		$this->audio_type = $type; 
		$this->audio_size = $size;
		$this->price = $price;
		$this->profile_id = $profileId;
		$connection = new pdoconn();
		$data = array("$this->audio_name", "$this->file", "$this->audio_type", "$this->audio_size", "$this->price" , "$this->audio_id", "$this->profile_id" );
		$STH = $connection->DBH->prepare("UPDATE audios SET audio_name = ? , file = ?, audio_type = ?, audio_size = ? , price =? WHERE audio_id = ? AND profile_id = ?");
		return $STH->execute($data);
	}
}


