<?php

class Admin_UsersController extends \BaseController {

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

	private $access;
	private $adminData;
	private $file;
	private $title;

	public function __construct() 
	{
		$this->adminData = Session::get('adminInfo');  	
		$this->access = unserialize($this->adminData->access);  
		$this->file = 'users';
		$this->title = 'User';
		Config::set('auth.model', 'Admin');
	}

	public function listAll( $page = 0 )
	{
		$data['file']		= $this->file;
		$data['title']		= $this->title."s";
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$search = Input::get('search');
		$limit = (Input::get('limit'))?$limit = Input::get('limit'):$limit=10;
		$from = ($page-1)*$limit;
		$order = (Input::get('order'))?Input::get('order'):'id';
		$orderby = (Input::get('orderby'))?Input::get('orderby'):'desc';
		$data['totalItems'] = Users::count();
		$data['items'] = Users::ListAll($search, $order, $orderby)->paginate($limit);

		return View::make('admin.users.list', $data);
	}

	public function exportAll()
	{

		if($this->access->users->export) {

			$data['file']		= $this->file;
			$data['title']		= $this->title."s";
			
			$data['adminData']	= $this->adminData;
			$data['access']		= (!$this->access)?new stdClass():$this->access;
			$search				= Input::get('search');
			$order				= (Input::get('order'))?Input::get('order'):'id';
			$orderby			= (Input::get('orderby'))?Input::get('orderby'):'desc';
			$data['items']		= Users::ListAll($search, $order, $orderby)->get(array('id','user','name','last_name','countryName','email','password','created_at','updated_at'))->toArray();
			$header				= array('ID','User','Last Name','Country','E-mail','Password','Created At','Updated At'); // top columns
			$autoFilter			= 'A1:H1'; // columns to set autoFilter
			$title				= 'Export - ' . $data['title'] . ' - ' . date("d-m-Y"); // title of file

			$toExcel			= $data['items'];
			array_unshift($toExcel,$header);

			Excel::create('Filename', function($excel) use ($toExcel, $title, $autoFilter) {
				$excel->setTitle($title);
			    $excel->sheet('Sheetname', function($sheet) use ($toExcel, $title, $autoFilter) {
					$sheet->setOrientation('landscape');
					$sheet->setAutoFilter($autoFilter);
				    $sheet->setStyle(array('font' => array('name' => 'Verdana','size' => 11, 'bold' => false)));
				    $sheet->freezeFirstRow();
			        $sheet->fromArray($toExcel);
			    });
			})->download('xls');

		}else{
			return Redirect::to('admin/users/list')->with('message_error', "This user can't export xls!");
		}
	}

	public function get_deleteItem( $id = null ) {
		if($this->access->users->delete) {
			$data['item'] = Users::find($id);
		}
		return View::make('admin.users.delete', $data);
	}

	public function post_deleteItem() {
		$idPost	= Input::get('id');
		$item	= Users::find($idPost);
		if($this->access->users->delete) {
			$item->delete();
			return Redirect::to('admin/users/list')->with('message_success', 'Item deleted success!');
		}			
	}

	public function get_editItem( $id = null ) {
		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Edit '.$this->title;

		if($this->access->users->edit) {
			$country = Country::all()->toArray();
			$data['item'] = Users::find($id);
			$data['country'] = array();
			foreach ($country as $key => $value) {
				$data['country'][$value['code']] = $value['name']; 
			}
			$data['item']['access'] = unserialize($data['item']['access']);

			return View::make('admin.users.form', $data);
		}
	}

	public function post_editItem() {
		
		if($this->access->users->edit) {

			$idPost	= Input::get('id');
			$user = Users::find($idPost);
			$inputs = Input::all();

			$rules = array(
				'user' 				=> 'required|min:4|max:50|unique:admin,user',
				'name' 				=> 'required|min:4|max:50',  
				'country' 			=> 'required', 
				'last_name' 		=> 'required|min:4|max:50',
				'email'				=> 'required|email|min:4|max:255|unique:admin,email',
            );

			$validate = Validator::make($inputs, $rules);
			if($validate->fails()){
				return Redirect::back()->with('message_error', 'Check your info')->withErrors($validate);
			}else{
				$user->user = Input::get('user');
				$user->name = Input::get('name');	
				$user->last_name = Input::get('last_name');	
				$user->country = Input::get('country');	
				$user->email = Input::get('email');	
				$user->picture = Input::get('picture');	


				$user->save();
				return Redirect::to('admin/users/list')->with('message_success', 'Item edited success!');
			}
			
		}		

	}

	public function get_createItem() {
		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Create '.$this->title;
		
		if($this->access->users->edit) {
			$country = Country::all()->toArray();
			$data['country'] = array();
			foreach ($country as $key => $value) {
				$data['country'][$value['code']] = $value['name']; 
			}
			return View::make('admin.users.form', $data);
		}
	}

	public function post_createItem() {
		
		if($this->access->users->create) {

			$inputs = Input::all();
			$rules = array(
				'user' 				=> 'required|min:4|max:50|unique:admin,user',
				'name' 				=> 'required|min:4|max:50',  
				'country' 			=> 'required', 
				'last_name' 		=> 'required|min:4|max:50',
				'email'				=> 'required|email|min:4|max:255|unique:admin,email',
			);

			$validate = Validator::make($inputs, $rules);
			if($validate->fails()){
				return Redirect::back()->with('message_error', 'Check your info')->withErrors($validate);
			}else{
				$users = new Users;
				$users->user = Input::get('user');
				$users->name = Input::get('name');	
				$users->last_name = Input::get('last_name');	
				$users->country = Input::get('country');	
				$users->email = Input::get('email');	
				$users->picture = Input::get('picture');				
				$users->save();
				
				return Redirect::to('admin/users/list')->with('message_success', 'Item created success!');
			}
			
		}			
	}


	public function get_visibleItem( $id = null ) {
		
		if($this->access->users->edit) {
			$admin = Users::find($id);
			if ( $admin->visible ) {
				$admin->visible = 0;
			}else{
				$admin->visible = 1;
			}
			$admin->save();

			return Redirect::to('admin/users/list')->with('message_success', 'Item visible is changed!');
		}
	}	

}