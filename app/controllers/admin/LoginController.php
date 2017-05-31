<?php

class Admin_LoginController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	//protected $layout = 'layouts.masterAdmin';

	public function __construct() 
	{
		Config::set('auth.model', 'Admin');
	}

	public function showLogin()
	{

		if(Auth::check()){

			return Redirect::to('admin/welcome');

		}else{
			$data['title'] = 'Admin Login';
			$data['file'] = 'Admin Login';
			return View::make('admin.login', $data);
		}
	}
	
	public function tryLogin()
	{
		if(Input::get('user')){

		    $u  = Input::get('user');
            $pw = md5("Phi".Input::get('password'));


			$result= Admin::verifyUser($u,$pw)->get()->first();  

				if(!empty($result)){
				Session::put('adminInfo', $result);

				// Usuarios::SetLogin($u,true);
				$this->SetLogin($result["id"],true);

				return Redirect::to('admin/welcome/');

					}else{

					$result2 = Admin::verifyJustUser($u)->get()->first(); 

					if(!empty($result2)){

					$this->SetLogin($result2["id"],false);	

					}	

						return Redirect::to('admin/login/')->with('message_error', 'Your username/password combination was incorrect.');
					}
			}else{

				return Redirect::to('admin/login/')->with('message_error', 'Your username/password combination was incorrect.');
			}
	}

	public function welcome()
	{

		$data['title'] = 'Welcome';
		$data['adminData'] = Session::get('adminInfo');  	
		$data['access'] = unserialize($data['adminData']->access);  
		if(!$data['access']){
			$data['access'] = new stdClass();
		}

		$data['file'] = "welcome";
		return View::make('admin.welcome', $data);

	}

	public function getLogout() {

	   // Auth::logout();
		Session::flush();
	    return Redirect::to('admin')->with('message_success', 'Your are now logged out!');

	}


	private function SetLogin($user,$flag) {


		$flag_data = ($flag)?"acceso_correcto":"acceso_incorrecto";

		DB::table('admin_accesos')->insert(
		    array(
		    	'id_admin'    => $user,
		    	 $flag_data   => 1,
		    	 'ip' 		  => $_SERVER['REMOTE_ADDR'],
		    	 'created_at' => date('Y-m-d H:i:s')
		    	 )
		);

	}

}