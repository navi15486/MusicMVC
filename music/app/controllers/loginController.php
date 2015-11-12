<?php 
require_once '../app/controllers/adminController.php';
require_once '../app/controllers/homeController.php';
class loginController extends Controller
{
	//User Login
	public function index() 
	{
		session_start();
		//If user is already logged in and set in the session, He must not see the login page again
		if( isset($_SESSION['user']) )
	   		 return header('Location: http://localhost/music/public/');
		$title = 'Login';
		$errors = [];
		//Checks if submit button is clicked
		if (isset($_POST['login'] ))
		{ 
			
			//Checks if username and password field are filled
			if(isset($_POST['username'],  $_POST['password']))
			{ 
				$fields = [
				'Username' => htmlspecialchars(trim($_POST['username'])),
				'Password'=> htmlspecialchars(trim($_POST['password']))
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
				//if there are more than 0 errors 
				if ($error > 0)
					return  $this->view('home/login' , ['title' => $title,'errors' => $errors]);  
				$username = htmlspecialchars(trim($_POST['username']));
				$password = htmlspecialchars(trim($_POST['password'])); 
				$user = $this->model('userModel');

				//if an account is not active
				if ($user->getActive($username) == 0)
					return  $this->view('home/login' , ['title' => $title,'message' => 'Please activate your account']);
				$userLogin= $user->login($username , $password); 

				//If user is successfully log in 
				if($userLogin)
				{
					//If user is not an admin
					if ($user->getGroupId() == 1)
					{ 
						$title = 'Aman';
						$_SESSION['user'] =  serialize($user);  

						if ($user->getProfile()->setProfile($user->getId()))
						{
							$user->getProfile()->setProfile($user->getId());
							$_SESSION['user'] =  serialize($user);
					  		$_SESSION['profile'] =  true; 
					 	    $image = $this->model('imageModel');
					        $image->getImageByProfile($user->getProfile()->getProfileId());
					 	    echo $user->getProfile()->getProfileId(); 
					  		$_SESSION['image'] = serialize($image); 
					     	header('Location: http://localhost/music/public/profile' );
						}
						else
						{
							return header('Location: http://localhost/music/public/profile/index' );
						}
					}

					//If user is an Admin
					else
					{
						  session_start();
						  $_SESSION['user'] =   serialize($user);  
						  $_SESSION['admin'] = true;
						 return header('Location: http://localhost/music/public/admin/' ); 
					}
				}
			}
			else 
			{
				$errors[] = 'Something went wrong';
				return $this->view('home/login' , ['title' => $title,'errors' => $errors ]);
			}
		}
		return $this->view('/home/login' , ['title' => "aman"  , 'errors' => $errors , 'message' => ""]);
	}

	//Show Profile after successfull login
	public function showProfile()
	{

		   $this->view('/user/profile');
	}

	//Logout the user
	public function logout()
	{
		session_start();
		session_unset();
		$home = new HomeController;
		return $home->index(); 
	}
	//reset the user password
	public function resetPassword()
	{
		session_start();
		$title = 'Reset Password';
		if( isset($_SESSION['user']) )
		{
			$errors = [];
			if (isset($_POST['reset'] ))
			{ 
				//Checks if username and password field are filled
				if(isset($_POST['password'],  $_POST['newPassword'] , $_POST['confirmPassword']))
				{
					$fields = [
					'password' => htmlspecialchars(trim($_POST['password'])),
					'newPassword'=> htmlspecialchars(trim($_POST['newPassword'])),
					'confirmPassword'=> htmlspecialchars(trim($_POST['confirmPassword']))
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
						return  $this->view('/user/resetPassword' , ['title' => $title,'errors' => $errors , 'message' => '']);
				}
				else 
				{
					$errors[] = 'Something went wrong';
					return $this->view('home/contact' , ['title' => $title,'errors' => $errors]);
				}
					$password = htmlspecialchars(trim($_POST['newPassword']));
					$user = $this->model('userModel');
					$user = unserialize($_SESSION['user']);
					$username = $user->getUsername();
					if ($user->resetPassword($username, $password))
					{
						session_unset();
						return $this->view('/home/index' , ['title' => $title, 'message' =>'Your password is Successfully Reset. Please Login again to continue']);
					}
					else
						return $this->view('/user/resetPassword' , ['title' => $title , 'message' =>'Could not Reset']);
				
			}
		}
		return $this->view('/user/resetPassword' , ['title' => $title , 'message' => '']);
	}

	//Unregister account for the user
	public function unregister()
	{
		session_start();
		if( isset($_SESSION['user']) )
		{
		$user = $this->model('userModel');
		$user = unserialize($_SESSION['user']);
		$user->unregisterUser($user->getUsername());
		session_unset();
		return $this->view('/home/index' ,  ['title'=>"Home" , 'message' => 'You are Unregistered. ']);
		}
		return $this->view('/home/index');
	}

	//Recover Password is used to recover the  password if any case u forget the password
	public function recoverPassword()
	{
		$title = 'Contact Us'; 
		require_once '../public/libs/PHPMailerAutoload.php';  
		$errors = [];

		 if (isset($_POST['recover']))
		 { 
			if( isset( $_POST['email']) ) 
			{ 
				$fields = [
				 'name'=> 'aman',
				 'message'=> 'hello',
				'email'=> htmlspecialchars(trim($_POST['email'])) 
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
					return  $this->view('home/recoverPassword' , ['title' => $title,'errors' => $errors]);
			} 
			else 
			{
				$errors[] = 'Something went wrong';
				return $this->view('home/recoverPassword' , ['title' => $title,'errors' => $errors]);
			}
			$m = new PHPMailer;
			$m->isSMTP();
			$m->SMTPAuth = true;

			$m->Host = 'smtp.gmail.com';
			$m->Username = 'incredible.navi@gmail.com';
			$m->Password = '';
			$m->SMTPSecure ='ssl';
			$m->Port = 465;
			$generatedPassword = substr(md5(rand(999,999999)), 0,8);

			$user = $this->model('userModel');
			if ($user->getUserByName($fields['email']))
			{
				$fields['name'] = $user->getFname();
			
			$username = $fields['email'];
			$user->resetPassword($username , $generatedPassword);

			$fields['message'] = $fields['message'] . ' ' . $fields['name'] . ', ' . ' your temporary password is ' . $generatedPassword; 
			
			$m->isHTML();
			$m->Body = 'From: ' . $fields['name'] . '(' .$fields['email'] . ')<p>' . $fields['message'] . '</p>';

			$m->FromName = 'Contact';

			
			$m->AddAddress('incredible.navi@gmail.com' , 'Amandeep');

		if($m->send())
		{ 
			session_start();
			$_SESSION['message'] =   'We have sent you an email with your temporary password';
			return header('Location: http://localhost/music/public/login');
		}
		else
			return $this->view('/home/recoverPassword'); 
		}
	}
		return $this->view('/home/recoverPassword' , ['title' => 'Recover Password']);
}

}