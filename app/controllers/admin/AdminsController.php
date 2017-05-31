<?php

class Admin_AdminsController extends \BaseController {

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
		$this->file = 'admin';
		$this->title = 'Admin';
		Config::set('auth.model', 'Admin');
	}

	public function listAll( $page = 0 )
	{
		//para las nuevas secciones
		// $section = new stdClass();
		// $actions = array('create' => 1 , 'delete' => 1 , 'edit' =>1 );
		// $section->admin = (object)$actions;
		// $section->users = (object)$actions;
		// var_dump($section);
		// echo serialize($section);

		$data['file']		= $this->file;
		$data['title']		= $this->title."s";
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$search = Input::get('search');
		$limit = (Input::get('limit'))?$limit = Input::get('limit'):$limit=10;
		$from = ($page-1)*$limit;
		$order = (Input::get('order'))?Input::get('order'):'id';
		$orderby = (Input::get('orderby'))?Input::get('orderby'):'desc';
		$data['totalItems'] = Admin::count();
		$data['items'] = Admin::ListAll($search, $order, $orderby)->paginate($limit);

		return View::make('admin.admins.list', $data);
	}

	public function exportAll()
	{
		
		if(!$this->access->users->export) {
			return Redirect::to('admin/admins/list')->with('message_error', "This user can't export xls!");
		}

		$data['file']		= $this->file;
		$data['title']		= $this->title."s";
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$search				= Input::get('search');
		$order				= (Input::get('order'))?Input::get('order'):'id';
		$orderby			= (Input::get('orderby'))?Input::get('orderby'):'desc';
		$data['items']		= Admin::ListAll($search, $order, $orderby)->get(array('id','user','email','role','updated_at'))->toArray();
		$header				= array('ID','User','E-mail','Role', 'Register'); // top columns
		$autoFilter			= 'A1:E1'; // columns to set autoFilter
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
	}

	public function get_deleteItem( $id = null ) {
		if($this->access->admin->delete) {
			$data['item'] = Admin::find($id);
		}
		return View::make('admin.admins.delete', $data);
	}

	public function post_deleteItem() {
		$idPost	= Input::get('id');
		if ( $idPost == 1 ) {
			return Redirect::to('admin/admins/list')->with('message_error', "This user can't be removed!");
		}
		$item	= Admin::find($idPost);
		if($this->access->admin->delete) {
			$item->delete();
			return Redirect::to('admin/admins/list')->with('message_success', 'Item deleted success!');
		}			
	}

	public function get_editItem( $id = null ) {
		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Edit '.$this->title;

		if ( $id == 1 && $this->adminData->id != 1 ) {
			return Redirect::to('admin/admins/list')->with('message_error', "This user can't be edited");
		}

		if($this->access->admin->edit) {
			$data['item'] = Admin::find($id);
			$data['item']['access'] = unserialize($data['item']['access']);

			if ( $data['item']->role == 'sadmin' && $this->adminData->role == 'admin' ) {
				return Redirect::to('admin/admins/list')->with('message_error', "The administrator user can't edit Super administrators");
			}

			return View::make('admin.admins.form', $data);
		}
	}

	public function post_editItem() {
		
		if($this->access->admin->edit) {

			// preparo access
			$users			= Input::get('users');
			$admin			= Input::get('admin');
			
			$section		= new stdClass();
			$section->admin	= (object) array('create' => (isset($admin['create']))?1:0 , 'delete' => (isset($admin['delete']))?1:0 , 'edit' => (isset($admin['edit']))?1:0, 'view'  => (isset($admin['view']))?1:0, 'export'  => (isset($admin['export']))?1:0);
			$section->users	= (object) array('create' => (isset($users['create']))?1:0 , 'delete' => (isset($users['delete']))?1:0 , 'edit' => (isset($users['edit']))?1:0, 'view'  => (isset($users['view']))?1:0, 'export'  => (isset($users['export']))?1:0);
			// preparo access

			$idPost	= Input::get('id');
			$admin = Admin::find($idPost);
			$inputs = Input::all();


			if ( $admin->id == 1 && $this->adminData->id != 1 ) {
				return Redirect::to('admin/admins/list')->with('message_error', "This user can't be edited");
			}

			if ( $admin->role == 'sadmin' && $this->adminData->role == 'admin' ) {
				return Redirect::to('admin/admins/list')->with('message_error', "The administrator user can't edit Super administrators");
			}

			$rules = array(
	           'email'				=> 'required|email|min:4|max:255|unique:admin,email,'.$idPost,
	           'password'			=> '',
	           'picture'			=> 'required',
	           'repeatpassword'	=> 'same:password'
            );

			$validate = Validator::make($inputs, $rules);
			if($validate->fails()){
				return Redirect::back()->with('message_error', 'Check your info')->withErrors($validate);
			}else{
				$admin->email = Input::get('email');
				$admin->picture = Input::get('picture');
				
				$repeat = Input::get('repeatpassword');
				if (!empty($repeat)) {
					$admin->password = Hash::make($repeat);
				}
				
				if($this->adminData->role == 'sadmin' && $idPost != 1) {
					$admin->role = Input::get('role');
					$admin->access = serialize($section);
				}
				$admin->save();
				return Redirect::to('admin/admins/list')->with('message_success', 'Item edited success!');
			}
			
		}		

	}

	public function get_createItem() {
		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Create '.$this->title;
		
		if($this->access->admin->edit) {
			return View::make('admin.admins.form', $data);
		}
	}

	public function post_createItem() {
		
		if($this->access->admin->create) {

			// preparo access
			$users			= Input::get('users');
			$admin			= Input::get('admin');
			
			$section		= new stdClass();
			$section->admin	= (object) array('create' => (isset($admin['create']))?1:0 , 'delete' => (isset($admin['delete']))?1:0 , 'edit' => (isset($admin['edit']))?1:0, 'view'  => (isset($admin['view']))?1:0, 'export'  => (isset($admin['export']))?1:0);
			$section->users	= (object) array('create' => (isset($users['create']))?1:0 , 'delete' => (isset($users['delete']))?1:0 , 'edit' => (isset($users['edit']))?1:0, 'view'  => (isset($users['view']))?1:0, 'export'  => (isset($users['export']))?1:0);
			// preparo access

			$inputs = Input::all();
			$rules = array(
				'user' 				=> 'required|min:4|max:50|unique:admin,user',
				'email'				=> 'required|email|min:4|max:255|unique:admin,email',
				'password'			=> '',
		        'picture'			=> 'required',
				'repeatpassword'	=> 'same:password'
			);

			$validate = Validator::make($inputs, $rules);
			if($validate->fails()){
				return Redirect::back()->with('message_error', 'Check your info')->withErrors($validate);
			}else{
				$admin = new Admin;
				$admin->user = Input::get('user');
				$admin->email = Input::get('email');
			    $admin->picture = Input::get('picture');
				$admin->password = Hash::make(Input::get('password'));
				$repeat = Input::get('repeatpassword');
				
				
				$admin->role = Input::get('role');

				if ( $admin->role == 'sadmin' && $this->adminData->role == 'admin') {
					return Redirect::to('admin/admins/list')->with('message_error', 'The administrator user can not create super-administrators!');
				}

				if($this->adminData->role == 'admin') {
					$admin->role = 'admin';
				}
				
				$admin->access = serialize($section);
				$admin->save();
				
				return Redirect::to('admin/admins/list')->with('message_success', 'Item created success!');
			}
			
		}			
	}


	public function get_visibleItem( $id = null ) {
		
		if ( $id == 1 ) {
			return Redirect::to('admin/admins/list')->with('message_error', "This user can't be edited");
		}

		if($this->access->admin->edit) {
			
			$admin = Admin::find($id);

			if ( $admin->role == 'sadmin' ) {
				if ( $admin->visible ) {
					$admin->visible = 0;
				}else{
					$admin->visible = 1;
				}
				$admin->save();

				return Redirect::to('admin/admins/list')->with('message_success', 'Item visible is changed!');
			}
		
		}
	}	

}