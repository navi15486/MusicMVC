<?php

class audioController extends Controller
{
	public function index()
	{
		//if the form was submitted
		if(isset($_POST['submit']))
		{
			 if (!isset($_POST['audioChoice']))
			 	return  $this->view('/user/uploadMusic' , ['title' => 'Uploading',  'message' => 'Please Choose Type of Audio']);
			  if (!isset($_POST['genre']))
			 	return  $this->view('/user/uploadMusic' , ['title' => 'Uploading',  'message' => 'Please Choose Type of Genre']);	
				$fields = [
					'Price'=> htmlspecialchars(trim($_POST['price']))
					];
					$error = 0;
					foreach($fields as $field => $data)
					{
					    if(empty($data)) 
					    {
					       $errors[] = 'The ' . $field . ' field is required';
					       $error = $error +1 ;
					    }
					}
					if ($error > 0)
						return  $this->view('/user/uploadMusic' , ['title' => 'Uploading','errors' => $errors , 'message' => 'Some Errors']);
				  
				$selected_song_or_instrumental = $_POST['audioChoice']; //get the given choice instrumental or song
				$selected_genre = $_POST['genre']; //get the music genre
				$song = 1;
				$instrumental = 0;
				$price = $_POST['price'];
				if ( $selected_song_or_instrumental == 'song')
				{
					$song = 1;
					$instrumental = 0;
				}
				else
				{
					$song = 0;
					$instrumental = 1;
				}

			$target_dir = "C:/xampp/htdocs/music/app/audio/"; 
			$target_file = $target_dir .  basename($_FILES["audioFile"]["name"]);
			$uploadOk = 1;
			$message = '';
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				/*
				This will verify if the audio is uploaded or not then verify if it is type MP3 or WAVE
				Once it is verified it will get the required information
				If successfully added to the database
				*/
			if(is_uploaded_file($_FILES['audioFile']['tmp_name']) && ($_FILES['audioFile']['type'] == "audio/mp3") || ($_FILES['audioFile']['type'] == "audio/wav") )
				{
					
						$type = $_FILES['audioFile']['type'];
						$type = pathinfo($target_file,PATHINFO_EXTENSION);
						$audio = fopen($_FILES['audioFile']['tmp_name'], 'rb'); //get the actual audio file
						$size = $_FILES['audioFile']['size']; //store the size
						$audioName = $_FILES['audioFile']['name']; //get namne of file
						$maxsize = 10388608; //set max size 8388608
						$nameFile = $_FILES['audioFile']['name']; //get namne of file
					}
					else
						return $this->view('user/uploadMusic', ['message'=>'Sorry, only MP3 files are allowed.']);


				$nameFile = uniqid() . $nameFile;
				//message
				
					// Check if file already exists
			if (file_exists($nameFile)) {
			    $message =  "Sorry, file already exists.";
			    $uploadOk = 0;
			    return $this->view('user/uploadMusic', ['message'=>'Sorry, file already exists.']);

			}
			// Check file size
			if ($_FILES["audioFile"]["size"] > 10388608) {
			    $message = "Sorry, your file is too large.";
			    $uploadOk = 0;
			    return $this->view('user/uploadMusic', ['message'=>'Sorry, your file is too large.']);
			}
			 
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $message =  "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else { 

			    if (move_uploaded_file($_FILES["audioFile"]["tmp_name"],   'C:/xampp/htdocs/music/app/audio/' . $nameFile)) {
			        $message =  "The file ". basename( $_FILES["audioFile"]["name"]). " has been uploaded.";
			    } else {
			    	$message = 'Sorry, there was an error uploading your file.';
			        return $this->view('user/uploadMusic', ['message'=> $message]);
			    }
			} 

						session_start();
						$user = $this->model('userModel');
						$user = unserialize($_SESSION['user']); 

						$profileId = $user->getProfile()->getProfileId(); 
						if ($user->getProfile()->getAudios()->add($nameFile, $selected_genre, $audio, $size, $type, $song, $instrumental, $price, $profileId)) 
						{

							return $this->view('user/uploadMusic', ['message'=>$message]);
						}
				 

		}

		return $this->view('user/uploadMusic', ['title'=>'Upload a Song']);
	}

	/*
	This function will be called when user wants to update or delete a song
	Depending on the submit button clicked it will call either delete or update
	*/
	public function manage()
	{
		session_start();
		$user = $this->model('userModel');
		$user = unserialize($_SESSION['user']); 

		$profileId = $user->getProfile()->getProfileId();
		if(isset($_POST['delete']))
		{
			$this->delete($profileId , $user);
			//return $this->view('user/audio' , ['message'=>'unsuccessfull']);
		}

		if(isset($_POST['update']))
		{
			$this->update($profileId , $user);
		}
		 
		$audioArray = $user->getProfile()->getAudios()->getAudiosById($profileId); 
		$this->view('user/audio', ['audioArray'=>$audioArray]);
	}

	/*
	This function will get the audio_Id and then delete the requested audio
	*/
	public function delete($profileId, $user)
	{	
		$id = $_POST['audioID']; 
		if ($user->getProfile()->getAudios()->delete($id))
		{
			$audioArray = $user->getProfile()->getAudios()->getAudiosById($profileId);
			return $this->view('user/audio', ['audioArray'=>$audioArray]); //returns audio array
		}
	}

	/*
	This function will get the audio_Id and then update the requested audio
	*/
	public function update($profileId, $user)
	{
		$id = $_POST['audioID'];
		echo $id;
		$price = trim($_POST['price']);
		if (!isset ($price) or empty($price))
		{
			$audioArray = $user->getProfile()->getAudios()->getAudiosById($profileId); 
			//$this->view('user/audio', ['audioArray'=>$audioArray]);
			return $this->view('user/audio', ['audioArray'=>$audioArray, 'message' => 'Please enter price' ] );
		}

		if(is_uploaded_file($_FILES['updateAudio']['tmp_name']) && ($_FILES['updateAudio']['type'] == "audio/mp3") || ($_FILES['updateAudio']['type'] == "audio/wav") )
			{
				
					$type = $_FILES['updateAudio']['type'];
					$audio = fopen($_FILES['updateAudio']['tmp_name'], 'rb'); //get the actual audio file
					$size = $_FILES['updateAudio']['size']; //store the size
					$audioName = $_FILES['updateAudio']['name']; //get namne of file
					$maxsize = 8388608; //set max size 8388608

				if($size < $maxsize)
				{ 

					
					if($user->getProfile()->getAudios()->updateAudio($id, $audioName, $audio, $size, $type,$price, $profileId))
						{
							$audioArray = $user->getProfile()->getAudios()->getAudiosById($profileId);
							return $this->view('user/audio', ['audioArray'=>$audioArray, 'message' => 'successfull' ] );
						}
					else
						{
							return $this->view('user/audio', ['audioArray'=>$audioArray, 'message' => 'unsuccessful' ] );
						}
				}

				//return $this->view('user/audio', ['audioArray'=>$audioArray] );
			}

			return $this->view('user/audio', ['audioArray'=>$audioArray, 'message' => 'not uploading' ] );
	}

	//A guest or user can see all the audios
	public function getAudios()
	{
		$audio = $this->model('audioModel');
		$audioArray = $audio->getAudios();

		//Like the audio
		if (isset($_POST['like']))
		{
			$audio_id = $_POST['audioID'];
			$audio->audioLikes($audio_id);
		}

		//Dislike the audio
		if (isset($_POST['dislike']))
		{
			$audio_id = $_POST['audioID'];
			$audio->audioDislikes($audio_id);
		}
		
		 if (isset($_POST['addtocart']))
		 {
		 	$cart = $this->model('cartModel');
		 	$audio_id = $_POST['audioID']; 
		 	$cart = $this->model('cartModel');
		 	$user = $this->model('userModel'); 
		 	session_start();
	 		$user = $this->model('userModel');
			$user = unserialize($_SESSION['user']);
			$profile_id = $user->getProfile()->getProfileId();  
		 	if ($profile_id)
		 	$cart->addCart( $audio_id , $profile_id );
		 

		 }
		return $this->view('home/allAudio', ['audioArray'=>$audioArray, 'message' => ' uploading' ] );
	}

	public function getPopularSongs()
	{

		$audio = $this->model('audioModel');
		$audioArray = $audio->getPopularSongs();

		//Like the audio
		if (isset($_POST['like']))
		{
			$audio_id = $_POST['audioID'];
			$audio->audioLikes($audio_id);
			return $this->view('home/popularSongs', ['audioArray'=>$audioArray, 'message' => ' uploading' ] );
		}

		//Dislike the audio
		if (isset($_POST['dislike']))
		{
			$audio_id = $_POST['audioID'];
			$audio->audioDislikes($audio_id);
		}
		
		 if (isset($_POST['addtocart']))
		 {
		 	$cart = $this->model('cartModel');
		 	$audio_id = $_POST['audioID'];
		 	
		 	$cart = $this->model('cartModel');
		 	$user = $this->model('userModel'); 
		 	session_start();
	 		$user = $this->model('userModel');
			$user = unserialize($_SESSION['user']);
			$profile_id = $user->getProfile()->getProfileId();  
		 	$cart->addCart( $audio_id , $profile_id );
		 }
		
		return $this->view('home/popularSongs', ['audioArray'=>$audioArray, 'message' => ' uploading' ] );
		
	}

	//download the music from the website
	public function downloadAudio($audioId)
	{
		$audio = $this->model('audioModel');
		$audioArray = $audio->getPopularSongs();
		
	}

}
