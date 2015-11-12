<?php
class eventController extends Controller
{
	public function index()
	{
		$title = "Event"; 
		if (isset($_POST['submit']))
		{

			if (isset($_POST['eventname'], $_POST['description'] ))
			{

				$fields = [
					'Password' => trim($_POST['eventname']),
					'NewPassword'=> trim($_POST['description']), 
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
						return  $this->view('/user/event' , ['title' => $title,'errors' => $errors , 'message' => '']);
				$eventName = $_POST['eventname'];
				$eventDesc = $_POST['description'];
				session_start();
				if (isset($_SESSION['user']))
				{
					echo "successfull";
					$user = $this->model('userModel');
					$event = $this->model('eventModel'); 
					$user = unserialize($_SESSION['user']);
					if($event->addEvent($eventName, $eventDesc, $user->getId()))
						return $this->view('/user/event' , ['title' => $title     ]);
					return $this->view('/user/profile' , ['title' => $title     ]);
				}
				
			}
		}
		return $this->view('/user/event' , ['title' => $title     ]);
	}

	public function showEvents()
	{
		$title = "Events";
		$event = $this->model('eventModel'); 
		if (isset($_POST['delete']))
		{
			$event_id = $_POST['event_id'];  
			$event->deleteEvent($event_id);

		}
		if (isset($_POST['update']))
		{
			if (isset($_POST['event_name'] ,$_POST['description'] ))
			{
			$eventName = trim($_POST['event_name']);
			$description = trim($_POST['description']);
			$event_id  = $_POST['event_id'];

			$event->updateEvent($eventName, $description, $event_id);
			}	
		}
		$events = $event->showEvent();
		$this->view('admin/events' , ['title' => $title , 'events' => $events]);
	}

	
	public function deleteEvent()
	{

	}
}