<?php

class registrationController extends Controller
{
	public function index()
	{
		$title = 'Registration';
		 $message = "";
		$errors = [];
		if(isset($_POST['submit']))
		{
			//Verify for the validation errors
			if(isset($_POST['fname'] , $_POST['lname'] , $_POST['username'] , $_POST['password'])) 
			{
				$fields = [
				'FirstName' => trim($_POST['fname']),
				'LastName'=> trim($_POST['lname']),
				'Username'=> trim($_POST['username']),
				'Password'=> trim($_POST['password']),
				];
				$error = 0;
				foreach($fields as $field => $data)
				{
				    if(empty($data)) 
				    {
				       $errors[] = 'The ' . $field . ' field is required';
				       $error = $error + 1 ; 
				    }    
				} 
				if ($error > 0)
					return  $this->view('home/registration' , ['title' => $title,'errors' => $errors]);
			}

			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email_code = md5($_POST['username'] + microtime());

			$user = $this->model('userModel');
			if ( !$user->getUserByName($username) )
			{
				$userId = $user->register($firstname, $lastname, $username, $password, $email_code , 1);
				
				//if a user has been registred
				if($userId)
				{
					if($this->sendEmail($firstname, $username , $email_code)) 
					{
						//return $this->view('home/login' , ['title' => $title,'message'=>'Registered Successfully. We have sent you an email. Please activate your account by clicking on the link' ]);
						$_SESSION['message'] = 'Registered Successfully. We have sent you an email. Please activate your account by clicking on the link';
						header("Location: http://localhost/music/public/login");
						 
					}
					else //if email not been sent, then u will have to register again
					{
						$user->deleteUser($userId);
						return $this->view('home/registration' , ['title' => $title,'message'=>'Some issues in ur email address' ]);
					}
						
				}
			}  
			$message = 'UserName already exist! Please choose another username';
		}	
		return $this->view('/home/registration' ,  ['title' => $title, 'message'=>$message ,'errors' => $errors]);
	}

	
	public function sendEmail($firstname, $username , $email_code)
	{
		 
		require_once '../public/libs/PHPMailerAutoload.php'; 
		$errors = [];
		$fields = [
		 'name'=> $firstname,
		 'message'=> 'Hello ' . $firstname .', Please click on this link to activate your music account http://localhost/music/public/registration/confirmAccount/?firstname=' . $firstname . '&email_code=' . $email_code . '&username=' . $username ,
		'email'=> $username
		 
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
			return false;
		
		$m = new PHPMailer;
		$m->isSMTP();
		$m->SMTPAuth = true;

		$m->Host = 'smtp.gmail.com';
		$m->Username = 'incredible.navi@gmail.com';
		$m->Password = '';
		$m->SMTPSecure ='ssl';
		$m->Port = 465;

		$m->isHTML();
		$m->Body = 'From: ' . $fields['name'] . '(' .$fields['email'] . ')<p>' . $fields['message'] . '</p>';

		$m->FromName = 'Contact';

		$m->AddAddress($fields['email'] , 'Music Store');
		if($m->send())
		{
			return true; 
		}
		//return $this->view('/home/registration' , ['message' => 'something went wrong']); 
		return false;
	}

	public function confirmAccount()
	{
		if(!empty($_GET["firstname"]) && !empty($_GET["username"] ) )
		{
			$firstname = $_GET["firstname"];
			$username =  $_GET["username"];
			$email_code = $_GET['email_code'];
			$user = $this->model('userModel');
			if ($user->confirm_code($username, $email_code ))
			{
			 	$message =  'Congratulation ' . $firstname . ' ! ' . ' Your account has been successfully activated.';  
				$user->activateAccount($username);
				return $this->view('/home/success' , ['message' => $message]);
			}
			return $this->view('/home/success' , ['message' => 'something went wrong']);
		}
	}
}