<?php

class AdminController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('admin', array(
			'except' => array(
				'getLogin',
				'postLogin'
			)
		));
	}

	public function getIndex()
	{
		return View::make('admin.index');
	}

	public function getLogin()
	{
		return View::make('admin.login');
	}

	public function postLogin()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		$user = User::where('username', '=', $username)
								->where('type', '=', 'admin')
								->first();
		if(isset($user->password) && Hash::check($password, $user->password))
		{
			Session::put('admin', $user);
		}
		
		return Redirect::to('/admin');
	}
}