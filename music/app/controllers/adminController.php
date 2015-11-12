<?php
/**
Controller fot the Admin, Admin can do whatever he wants with the table data
**/
class adminController extends Controller
{
	//index is the default function
	public function index()
	{
		session_start();
		$title = 'Admin';
		//if (isset($_POST['addUser']))
			//return header('Location: http://localhost/music/public/login' );

		//if user is set as admin
		if (isset($_SESSION['user'] , $_SESSION['admin']))
		{
		 $userTable = $this->model('userModel');
		 $users = $userTable->getUsers();

		 //If Update button is clicked
		 if (isset($_POST['update']))
			{ 
				//if an admin enter all the information
				if (isset($_POST['fname'] , $_POST['lname'] , $_POST['username'] , $_POST['password'] , $_POST['unregister'] , $_POST['groupId']  ))
				{
					$firstname = htmlspecialchars(trim($_POST['fname']));
					$lastname  = htmlspecialchars(trim($_POST['lname']));
					$username = htmlspecialchars(trim($_POST['username']));
					$password = htmlspecialchars(trim($_POST['password']));
					$groupId    = htmlspecialchars(trim($_POST['groupId']));
					$unregistred = htmlspecialchars(trim($_POST['unregister']));
					$userId = htmlspecialchars(trim($_POST['userId']));
					if ($userTable->updateUser($firstname, $lastname, $username , $password, $groupId, $unregistred , $userId))
					{
						$users = $userTable->getUsers();
						return $this->view('/admin/home' , ['title' => $title , 'users' => $users   ]); 	
					}
				}
			}

			//delete a record
			else if (isset($_POST['delete']))
			{
				$userId = htmlspecialchars(trim($_POST['userId']));
				if ($userTable->deleteUser($userId))
				{
					$users = $userTable->getUsers();
					return $this->view('/admin/home' , ['title' => $title , 'users' => $users   ]);
				}
				else
					return $this->view('/admin/gg' , ['title' => $title , 'users' => $users   ]);

			}

		return $this->view('/admin/home' , ['title' => $title , 'users' => $users   ]);
		}
		return header('Location: http://localhost/music/public/login' );
	}

   // logout function to unset logout the admin
	public function logout()
	{
		 $title = 'Logout';
		session_start();
		session_unset(); 
		return header('Location: http://localhost/music/public/login' );
	}

	//Add a new user to the database 
	public function addUser()
	{
		$title = 'Add a user';

		//if Add user tab is clicked
		if (isset($_POST['addUser']))
		{	
			if(isset($_POST['fname'], $_POST['lname'], $_POST['username'], $_POST['password'] ))
			{
				$firstname = htmlspecialchars(trim($_POST['fname']));
				$lastname = htmlspecialchars(trim($_POST['lname']));
				$username = htmlspecialchars(trim($_POST['username']));
				$password = htmlspecialchars(trim($_POST['password']));
				$userTable = $this->model('userModel');

				if ($userTable->register($firstname, $lastname, $username, $password, 1))
				{
					$userTable = $this->model('userModel');
		 			$users = $userTable->getUsers();
		 			$title = 'Profile';
					return $this->view('/admin/home' , ['title' => $title ,'users' => $users] );
				}
			}
		}
		return $this->view('/admin/addUser' , ['title' => $title] );
	} 

}