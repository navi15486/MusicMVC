<?php

class profileController extends Controller
{
	public function index()
	{ 
		//verify if all data was submitted then retrieve data from the form based on their field name
		session_start();
		$title = 'Profile';
		if (isset($_SESSION['profile']))
		{
			return $this->view('user/profile' , ['title' => $title]);
		}
		$errors = [];

		if(isset($_POST['submit']))
		{ 
			//Verify for the validation errors
			if(isset($_POST['name'] , $_POST['age'] , $_POST['country'] , $_POST['city'] , $_POST['paypalAccount'])) 
			{
				$fields = [
				'Name' => trim($_POST['name']),
				'Age'=> trim($_POST['age']),
				'Country'=> trim($_POST['country']),
				'City'=> trim($_POST['city']),
				'Paypal'=> trim($_POST['paypalAccount'])
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
					return  $this->view('user/createProfile' , ['title' => $title, 'errors' => $errors]);
			} 
			$name = $_POST['name'];
			$paypalAccount = $_POST['paypalAccount'];
			$age = $_POST['age'];
			$country = $_POST['country'];
			$city = $_POST['city'];
			$singer = 0;
			$producer = 0; 
			$user = $this->model('userModel');
			$user = unserialize($_SESSION['user']); 
			$userId = $user->getId(); 

			//check to see if checkbox singer is checked
			if(isset($_POST['singer']))
				$singer = 1;
			
			//check to see if checkbox producer is checked
			if(isset($_POST['producer']))
				$producer = 1;

			$target_dir = "profileImages/"; 
			$target_file = $target_dir .  basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$message = '';
			//check if image was correctly uploaded 
			if(is_uploaded_file($_FILES['fileToUpload']['tmp_name']) && getimagesize($_FILES['fileToUpload']['tmp_name']) != false)
				{

					$size = getimagesize($_FILES['fileToUpload']['tmp_name']); //get file size
					$type = $size['mime']; //get file type
					$imgfp = fopen($_FILES['fileToUpload']['tmp_name'], 'rb'); //get the actual image file
					$size = $size[3]; //store the size
					$nameFile = $_FILES['fileToUpload']['name']; //get namne of file
					$maxsize = 99999999; //set max size 
				}

			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg"  && $imageFileType != "JPG" && 
				$imageFileType != "png" && $imageFileType != "PNG"
				&& $imageFileType != "JPEG" &&  $imageFileType != "jpeg" 
			&& $imageFileType != "gif" && $imageFileType != "GIF" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
					$nameFile = uniqid() . $nameFile;
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],   'D:/xampp/htdocs/music/app/profileImages/' . $nameFile)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
 
				$profileId = $user->getProfile()->add( $name, $paypalAccount, $userId, $age, $country, $city, $singer, $producer);
				$_SESSION['profile'] = true;
				$_SESSION['user'] =  serialize($user);
				if($_FILES['fileToUpload']['size'] < $maxsize)
				{
					$imageMod = $this->model('imageModel');
					$imageID = $imageMod->add($profileId,$type, $imgfp, $size, $nameFile);
					$_SESSION['image'] =  serialize($imageMod); 
				}
				return $this->view('user/profile' , ['title' => $title, 'user' => $user , 'image' => $imageMod]);
		}	
 		//if user already loggin in, but didnot complete the id
		return $this->view('user/createProfile', ['title' => $title, 'errors' => $errors]);
	}

	//Remove the Profile
	public function removeProfile()
	{
		session_start(); 
		$user = $this->model('userModel');
		$user = unserialize($_SESSION['user']);
		if ($user->getProfile()->removeProfile($user->getId()))
		{
			unset($_SESSION['profile']);
			return header('Location: http://localhost/music/public/');
		}
	}
	 
	//update the profile
	public function updateProfile()
	{
		//verify if all data was submitted then retrieve data from the form based on their field name
		session_start();
		$title = 'Update Profile';

		/*if (isset($_SESSION['profile']))
		{
			return $this->view('user/profile' );
		}
		*/
		$errors = [];

		if(isset($_POST['submit']))
		{ 
			//Verify for the validation errors
			if(isset($_POST['name'] , $_POST['age'] , $_POST['country'] , $_POST['city'] , $_POST['paypalAccount'])) 
			{
				$fields = [
				'Name' => trim($_POST['name']),
				'Age'=> trim($_POST['age']),
				'Country'=> trim($_POST['country']),
				'City'=> trim($_POST['city']),
				'Paypal'=> trim($_POST['paypalAccount'])
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
					return  $this->view('user/updateProfile' , ['title' => $title, 'errors' => $errors]);
			} 
			$name = $_POST['name'];
			$paypalAccount = $_POST['paypalAccount'];
			$age = $_POST['age'];
			$country = $_POST['country'];
			$city = $_POST['city'];
			$singer = 0;
			$producer = 0; 
			$user = $this->model('userModel');
			$user = unserialize($_SESSION['user']); 
			$userId = $user->getId(); 

			//check to see if checkbox singer is checked
			if(isset($_POST['singer']))
				$singer = 1;
			
			//check to see if checkbox producer is checked
			if(isset($_POST['producer']))
				$producer = 1;

			$target_dir = "profileImages/"; 
			$target_file = $target_dir .  basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$message = '';
			//check if image was correctly uploaded 
			if(is_uploaded_file($_FILES['fileToUpload']['tmp_name']) && getimagesize($_FILES['fileToUpload']['tmp_name']) != false)
				{

					$size = getimagesize($_FILES['fileToUpload']['tmp_name']); //get file size
					$type = $size['mime']; //get file type
					$imgfp = fopen($_FILES['fileToUpload']['tmp_name'], 'rb'); //get the actual image file
					$size = $size[3]; //store the size
					$nameFile = $_FILES['fileToUpload']['name']; //get namne of file
					$maxsize = 99999999; //set max size 
				}

			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg"  && $imageFileType != "JPG" && 
				$imageFileType != "png" && $imageFileType != "PNG"
				&& $imageFileType != "JPEG" &&  $imageFileType != "jpeg" 
			&& $imageFileType != "gif" && $imageFileType != "GIF" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
					$nameFile = uniqid() . $nameFile;
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],   'D:/xampp/htdocs/music/app/profileImages/' . $nameFile)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
 				$profileId = $user->getProfile()->getProfileId();
				 $user->getProfile()->updateProfile($name, $paypalAccount, $age, $country, $city, $singer, $producer , $profileId);
				$_SESSION['profile'] = true;
				$_SESSION['user'] =  serialize($user);
				if($_FILES['fileToUpload']['size'] < $maxsize)
				{
					$imageMod = $this->model('imageModel');
					//$imageID = $imageMod->add($profileId,$type, $imgfp, $size, $nameFile);
					$imageID =$imageMod->updateImage($type, $image, $size, $nameFile,$profileId);
					$_SESSION['image'] =  serialize($imageMod); 
				}
				return $this->view('user/profile' , ['title' => $title, 'user' => $user , 'image' => $imageMod]);
		}	
 		//if user already loggin in, but didnot complete the id
		//return $this->view('user/createProfile', ['title' => $title, 'errors' => $errors]);
		 return $this->view('user/updateProfile' , [ 'title' => $title] );
	}

	public function showImage()
	{
		return $this->view('user/dbImage' );
	}

	public function upload()
	{
		$target_dir = "profileImages/"; 
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); 
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        echo $imageFileType;
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {

		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],   'C:/xampp/htdocs/music/app/' . $target_file)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
}