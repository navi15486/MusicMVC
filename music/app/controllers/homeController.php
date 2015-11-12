<?php

class HomeController extends Controller
{
	public function index()
	{
		$title = 'Home';
		$event = $this->model('eventModel');
		$events = $event->showEvent();
		$this->view('home/index' , ['title' => $title , 'events' => $events]);
	}

	public function contact()
	{
		$title = 'Contact Us'; 
		require_once '../public/libs/PHPMailerAutoload.php';  
		$errors = []; 
		 if (isset($_POST['submit']))
		 { 
			if(isset($_POST['name'] , $_POST['email'] , $_POST['message'])) 
			{ 
				$fields = [
				'name' => trim($_POST['name']),
				'email'=> trim($_POST['email']),
				'message'=> trim($_POST['message'])
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
					return  $this->view('home/contact' , ['title' => $title,'errors' => $errors]);
			} 
			else 
			{
				$errors[] = 'Something went wrong';
				return $this->view('home/contact' , ['title' => $title,'errors' => $errors]);
			}
			$m = new PHPMailer;
			$m->isSMTP();
			$m->SMTPAuth = true;

			$m->Host = 'smtp.gmail.com';
			$m->Username = 'incredible.navi@gmail.com';
			$m->Password = ' ';
			$m->SMTPSecure ='ssl';
			$m->Port = 465;

			$m->isHTML();
			$m->Body = 'From: ' . $fields['name'] . '(' .$fields['email'] . ')<p>' . $fields['message'] . '</p>';

			$m->FromName = 'Contact';

			$m->AddAddress('incredible.navi@gmail.com' , 'Amandeep');
		if($m->send())
		{
			header('Location: http://localhost/music/public/home/sendComment'); 
			echo 'success';
		}
		else
		{
			return $this->view('home/contact' , ['title' => 'SOME ISSUES','errors' => $errors]);
		}
	
	} 
	return $this->view('home/contact' , ['title' => $title,'errors' => $errors]);
}

	public function sendComment()
	{
		$title = 'SendComment';
		$this->view('home/sendComment' , ['title' => $title]);
	}
	public function about()
	{
		$title = 'About us';
		$this->view('home/about' , ['title' => $title]);
	} 	
}