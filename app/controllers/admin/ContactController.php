<?php

class Admin_ContactController extends \BaseController {

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
		$this->file = 'contact';  
		$this->title = 'Contact'; 
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
	 	$data['totalItems'] = Contact::count();
		$data['items'] = Contact::ListAll($search, $order, $orderby)->paginate($limit);
	//  $data['items'] = Contact::ListAll($search, $order, $orderby)->paginate($limit)->toArray();

		return View::make('admin.carrers_contact.list', $data);
	}


	public function exportAll()
	{

		if($this->access->carrers_con->export) {

			$data['file']		= $this->file;
			$data['title']		= $this->title."s";
			
			$data['adminData']	= $this->adminData;
			$data['access']		= (!$this->access)?new stdClass():$this->access;
			$search				= Input::get('search');
			$order				= (Input::get('order'))?Input::get('order'):'id';
			$orderby			= (Input::get('orderby'))?Input::get('orderby'):'desc';
			$data['items']		= Contact::ListAll($search, $order, $orderby)->get()->toArray();
			$header				= array('ID','Name','Area','City','State','Email','Created At'); // top columns
			$autoFilter			= 'A1:H1'; // columns to set autoFilter
			$title				= 'Export - ' . $data['title'] . ' - ' . date("d-m-Y"); // title of file

			$toExcel			= $this->clear_array($data['items']);
			array_unshift($toExcel,$header);


			Excel::create('Contacts', function($excel) use ($toExcel, $title, $autoFilter) {
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
		if($this->access->carrers_con->delete) {
			$data['item'] = Contact::find($id);
		}
		return View::make('admin.carrers_contact.delete', $data);
	}

	public function post_deleteItem() {
		$idPost	= Input::get('id');
		$item	= Contact::find($idPost);
		if($this->access->carrers_con->delete) {
			$item->delete();
			return Redirect::to('admin/contact/')->with('message_success', 'Item deleted success!');
		}			
	}



	public function get_createItem() {

		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Create '.$this->title;
		
		if($this->access->carrers_con->create) {
		$areas = Areas::all()->toArray();

		$data['areas'] = array();
		foreach ($areas as $key => $value) {
		$data['areas'][$value['id']] = $value['name']; 
		}
		
		$data['ckeditor']=true;

		return View::make('admin.carrers_jobs.form', $data);

		}
	}

	public function post_createItem() {
		
		if($this->access->carrers_con->create) {

			$inputs = Input::all();
			$rules = array( 
				'title' 			=> 'required|min:2|max:50',     //  unique:admin,user',
				'area' 			    => 'required', 
				'description' 		=> 'required|min:4|max:500',  //'email'=> 'required|email|min:4|max:255|unique:admin,email',			
			);

			$validate = Validator::make($inputs, $rules);
			if($validate->fails()){
				return Redirect::back()->with('message_error', 'Check your info')->withErrors($validate);
			}else{

				$jobs = new Carrersjobs;

				$jobs->title 	    = Input::get('title');
				$jobs->type 	    = Input::get('area');	
				$jobs->description  = Input::get('description');					
				$jobs->save();
				
				return Redirect::to('admin/carrers_jobs/list')->with('message_success', 'Item created success!');
			}
			
		}			
	}


	public function get_visibleItem( $id = null ) {
		
		if($this->access->carrers_con->edit) {
			$admin = Carrersjobs::find($id);

			if ( $admin->visible ) {
				$admin->visible = 0;
			}else{
				$admin->visible = 1;
			}
			$admin->save();

			return Redirect::to('admin/carrers_jobs/list')->with('message_success', 'Item visible is changed!');
		}
	}	

//  = array('ID','Area','Title','Description','Visible','Created At','Updated At'); // top columns

		public function clear_array($array){

			$new=array();
			$i=0;

			foreach ($array as $key => $value) {

					$new[$i]['id']    		= $value['id_contact'];
					$new[$i]['name']  		= $value['contact_name'].' '.$value['last_name'];
					$new[$i]['area'] 		= $value['type_job'];
					$new[$i]['city']        = $value['city'];
					$new[$i]['state']		= $value['contact_state'];
					$new[$i]['email']       = $value['email'];
					$new[$i]['created_at']  = $value['contact_date'];  			 
					
					$i++;
				}

				return $new;
		}


		public function get_download($file){

			$result= Contact::Findfile($file)->get()->first()->toArray();

		    if( (!empty($result))&&(is_file('./public/upload/contact/'.$result['file'].'.'.$result['file_type'])) ){

	        $file= public_path(). "/upload/contact/".$result['file'].'.'.$result['file_type'];

        	$headers = array(
              'Content-Type: application/'.$result['file_type'],
            );

	        return Response::download($file, $result['file'].'.'.$result['file_type'], $headers);
			 }
		}


}