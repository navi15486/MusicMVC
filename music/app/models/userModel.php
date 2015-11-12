<?php

require_once '../app/core/database.php';
require_once '../app/models/profileModel.php';
class userModel
{
	private $userId;
	private $firstname;
	private $lastname;
	private $username; 
	private $password;
	private $groupid ;
	private $created_at;
	private $updated_at;
	private $unregistered;
	private $profile; 
	private $shoppingCart;
	private $active;

	//return the active status
	public function getActive($username)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT email_code,active  FROM users where username = ?");
		$STH->bindParam(1,$username);
		$STH->execute();
		if($row = $STH->fetch())
		{
		$this->email_code = $row['email_code'];
		$this->active = $row['active'];
		return $this->active;
		} 
	} 

	//Active the Account
	public function activateAccount($username)
	{
		$connection = new pdoconn(); 
		$STH = $connection->DBH->prepare("UPDATE users SET active = 1  WHERE username =  ?");
		$STH->bindParam(1,$username);  
		return $STH->execute();
	}
	//get all the rows of users table
	public function getUsers()
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM users");
		$STH->execute();
		//$user = new $thisuserModel;
		$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		$users = [];
		foreach ($rows as $row) {
			$user = new userModel;
			$user->userId = $row['user_id']; 
			$user->firstname = $row['firstname']; 
			$user->lastname = $row['lastname'];
			$user->username = $row['username']; 
			$user->password = $row['password'];
			$user->groupid = $row['groupid'];
			$user->created_at = $row['created_at'];
			$user->updated_at =  $row['update_at'];
			$user->unregistered = $row['unregistered'];
			$users[] = $user; 
		}
		return $users;
	}

	//Forgot Password- Change Pasword
	public function forgotPassword()
	{
	}

	//Get user by username
	public function getUserByName($username)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM users  where username =  ?");
		$STH->bindParam(1,$username);
		$STH->execute();
		if($row = $STH->fetch())
		{
			$this->firstname = $row['firstname'];
			return true;
		}
		return false;
	}

	//check if a user exist with the same email_code
	public function confirm_code($username, $email_code)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM users  where username =  ? and email_code = ?");
		$STH->bindParam(1,$username);
		$STH->bindParam(2,$email_code);
		$STH->execute();
		if($row = $STH->fetch())
		{
			return true;
		}
		return false;
	}


	public function register($firstname, $lastname, $username, $password, $email_code , $groupId = 0)
	{
		 
		$connection = new pdoconn();
		$options = [
    		'cost' => 12,
			];
		$password = password_hash($password,PASSWORD_BCRYPT, $options);
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->username = $username;
		$this->password = $password;
		$this->email_code = $email_code;
		$this->created_at = date('Y-m-d H:i:s');  
		$data = array("$this->firstname", "$this->lastname", "$this->username" , "$this->password", "$email_code" , "$groupId", "$this->created_at");
		$STH = $connection->DBH->prepare("INSERT INTO users (firstname, lastname, username, password, email_code, groupid, created_at) VALUES (?, ?, ?,?,?,?,?)");
		 
		if ($STH->execute($data))
		{
			$this->groupid = $groupId;
			$this->userId = $connection->DBH->lastInsertId();
			$this->profile = new profileModel;
			return  $this->userId;
		}
		return 0; 
	}
 
	public function login($username,$password)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("SELECT * FROM users  where username =  ?");
		$STH->bindParam(1,$username);
		$STH->execute();
		if($row = $STH->fetch())
		{ 
			if (password_verify($password,$row['password']) && $row['unregistered'] == 0 && $row['active'] ==1)
			{
				$this->userId = $row['user_id'];
				$this->groupid = $row['groupid'];
				$this->username = $row['username'];
				$this->password = $row['password'];
				$this->active = $row['active'];
				$this->email_code = $row['email_code'];
				$this->profile = new profileModel();
				//$this->profile->setUserId($this->userId);
				return true;
			}
		}
		 	return false;
	}


	//get Name of the user
	public function getFname()
	{
		return $this->firstname;
	}
	//Get Last name
	public function getLname()
	{
		return $this->lastname;
	}
	//Get group Id
	public function getGroupId()
	{
		return  $this->groupid;
	}
	/*** Returns current user ***/
	public function getId() 
	{
		return $this->userId;
	}

	public function getProfile()
	{
		return $this->profile;
	}
	public function setProfile($profile)
	{
		$this->profile = $profile;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}
 
	public function getUpdateAt()
	{
		return $this->updated_at;
	}
	public function getCreatedAt()
	{
		return $this->created_at;
	}
	public function getUnregistered()
	{
		return $this->unregistered;
	}
	 

	//Reset the password
	public function resetPassword($username , $password)
	{
		$connection = new pdoconn();
		$this->updated_at = date('Y-m-d H:i:s');
		$options = [
    		'cost' => 12,
    		];
		$password = password_hash($password,PASSWORD_BCRYPT, $options);
		$STH = $connection->DBH->prepare("UPDATE users SET password = ? , update_at = ?   WHERE username =  ?");
		$STH->bindParam(1,$password);
		$STH->bindParam(2,$this->updated_at);
		$STH->bindParam(3,$username);
		return $STH->execute();
	}

	//delete a user
	public function deleteUser($userId)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("DELETE  FROM users  where user_id =  ?");
		$STH->bindParam(1,$userId);
		return $STH->execute();
	}

	public function updateUser($firstname, $lastname, $username , $password, $groupId,$unregistered,$userId)
	{

		$this->updated_at = date('Y-m-d H:i:s');
		 $options = [
    	'cost' => 12,
		];
		$password = password_hash($password,PASSWORD_BCRYPT, $options);
		$data = array("$firstname", "$lastname", "$username" , "$password", "$groupId", "$this->updated_at","$unregistered", "$userId");
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("update users  set firstname = ? , lastname = ? , username = ? , password = ? , groupid = ?, update_at = ? , unregistered = ?  where user_id =  ?");
		//$STH->bindParam(1,$userId);
		if ($STH->execute($data))
			return true;
		else 
			return false;
	}

	// unregisterd a user unregisterUser
	public function unregisterUser($username)
	{
		$connection = new pdoconn();
		$STH = $connection->DBH->prepare("UPDATE users SET unregistered = 1  WHERE username =  ?");
		$STH->bindParam(1,$username);
		return $STH->execute();
	}
 
}

