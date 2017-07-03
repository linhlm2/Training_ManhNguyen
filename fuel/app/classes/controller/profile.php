<?php

class Controller_Profile extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Profile &raquo; Index';
		$this->template->content = View::forge('profile/index', $data);
	}

}
