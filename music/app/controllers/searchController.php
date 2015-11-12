<?php

class searchController extends Controller
{
	public function index()
	{
		$title = 'Search';
		//If search queryString is not empty
		if(!empty($_GET["search"]))
		{
			$name = $_GET["search"];
			$profile = $this->model('profileModel');
			$profiles = $profile->searchProfile($name);
			return $this->view('home/search' , ['profiles'=>$profiles , 'title' => $title] ); 
		} 
		//if profile queryString is not empty
		if(!empty($_GET["profile"]))
		{
			$id = $_GET["profile"];
			$profileData = $this->model('profileModel');
			$profile = $profileData->getProfile($id); 
			return $this->view('home/search' , ['profile'=>$profile, 'title' => $title] );  
		} 
		return $this->view('home/search' , ['title'=>$title  ] );
	}
}