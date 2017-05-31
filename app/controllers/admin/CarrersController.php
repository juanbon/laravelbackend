<?php

class Admin_CarrersController extends \BaseController {

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
		$this->file = 'carrers_jobs';  
		$this->title = 'Carrer Job'; 
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
		$data['totalItems'] = Carrersjobs::count();

		$data['items'] = Carrersjobs::ListAll($search, $order, $orderby)->paginate($limit);

		return View::make('admin.carrers_jobs.list', $data);
	}



	public function exportAll()
	{
		if($this->access->carrers_jobs->export) {

 			$items = Carrersjobs::all()->toArray();
      		$space="          ";

	        $fields = array(
		            'id'          => 'Id '.$this->title,
		            'link'		  => 'Link',
  		            'image'		  => 'Image',
		            'visible'     => 'Visible',
		            'created_at'  => 'Created At'           
	      	  );

	        $query = array();
	        foreach ($items as $item)
	        {

				$visible=($item['visible'])?'activado':'desactivado';

		        $item = array(

						'id'               => $item['id'],
						'link'             => $item['link'],
						'image'            => $item['image'],
						'visible'          => $visible,
						'created_at'       => $item['created_at']
		        );
		        $query[] = $item;
	        }


     	   echo arrayToExcelDos($query, $fields,'Carrers');

	    }

	}

	public function get_deleteItem( $id = null ) {
		if($this->access->carrers_jobs->delete) {
			$data['item'] = Carrersjobs::find($id);
		}
		return View::make('admin.carrers_jobs.delete', $data);
	}

	public function post_deleteItem() {
		$idPost	= Input::get('id');
		$item	= Carrersjobs::find($idPost);
		if($this->access->carrers_jobs->delete) {
			$item->delete();
			return Redirect::to('admin/carrers_jobs/list')->with('message_success', 'Item deleted success!');
		}			
	}

	public function get_editItem( $id = null ) {

		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Edit '.$this->title;

		if($this->access->carrers_jobs->edit) {
		
			$data['item'] = Carrersjobs::find($id);

			$data['item']['access'] = unserialize($data['item']['access']);


			return View::make('admin.carrers_jobs.form', $data);
		}
	}

	public function post_editItem() {
		
		if($this->access->carrers_jobs->edit) {

			$error        ='Check your info';

			$idPost	      = Input::get('id');
			$item         = Carrersjobs::find($idPost);
			$file        = Input::file("image");
			$edited_image = Input::get("edited_image");
			$inputs       = Input::all();

			$rules = array( 
				'link' 			=> 'required|min:2',   		
			);

			$validate = Validator::make($inputs, $rules);

			
			if(!$validate->fails()){

				if(!$this->valid_url(Input::get('link'))){

 				$error="Check your URL link";
 				goto b;

				}

			if((empty($file)) && ($edited_image=="")){

				$error='Image required!';
				goto b;
			}

				if(($edited_image)==""){

					$ext=explode(".", Input::file("image")->getClientOriginalName());
					$image="news_".time().".".$ext[count($ext)-1]; 

				}else{

					$image=$edited_image;
				}

			if(($edited_image=="")&&($file->getSize()>4194304)){
			    	$error='The limit for Images is 4 MB.';
				    goto b;
				}
			

				$item->link 	    = $this->add_http(Input::get('link'));
				$item->image        = $image; 

		        if($item->save()){						

		        		if($edited_image==""){

				            $file->move(public_path().'/upload/carrers_jobs',Input::file("image")->getClientOriginalName());
							$path=public_path().'/upload/carrers_jobs/';
				            rename($path.Input::file("image")->getClientOriginalName(), $path.$image);
			          
			        	}					          
			           	return Redirect::to('admin/carrers_jobs/list')->with('message_success', 'Item edited success!'); 
		    		    } 
					}else{

					b:
					return Redirect::back()->with('message_error', $error)->withErrors($validate);

					}
			}		
		}

	public function get_createItem() {

		$data['file']		= $this->file;
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$data['title']		= 'Create '.$this->title;
		
		if($this->access->carrers_jobs->create) {
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
		
		if($this->access->carrers_jobs->create) {

			$error='Check your info';
			$file   = Input::file("image");
			$inputs = Input::all();
			$rules = array(
				'link' 			=> 'required|min:2',
			    'image'         => 'required|image|max:4096' 	
				);

			$messages = array(
              'max' => 'The limit for Images is 4 MB.'
            );

			$validate = Validator::make($inputs, $rules, $messages);

			if(!$validate->fails()){

 				if(!$this->valid_url(Input::get('link'))){

 				$error="Check your URL link";
 				goto b;

				}

				$ext=explode(".", Input::file("image")->getClientOriginalName());
				$image="carrers_".time().".".$ext[count($ext)-1];   

				$jobs = new Carrersjobs;

				$jobs->link 	    = $this->add_http(Input::get('link'));	
				$jobs->image 	    = $image;				

				if($jobs->save()){

				$file->move(public_path().'/upload/carrers_jobs',Input::file("image")->getClientOriginalName());

				$path=public_path().'/upload/carrers_jobs/';

				rename($path.Input::file("image")->getClientOriginalName(), $path.$image);	

				return Redirect::to('admin/carrers_jobs/list')->with('message_success', 'Item created success!');

				}

			}else{

				b:
				return Redirect::back()->with('message_error', $error)->withErrors($validate);

			}
			
		}			
	}


	public function get_visibleItem( $id = null ) {
		
		if($this->access->carrers_jobs->edit) {
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

		public function clear_array($array){

			$new=array();
			$i=0;

			foreach ($array as $key => $value) {

					$new[$i]['id']    		= $value['id'];
					$new[$i]['area']  		= $value['area'];
					$new[$i]['title'] 		= $value['title'];
					$new[$i]['description'] = $value['description'];
					$new[$i]['visible']		= ($value['visible'])?'yes':'no';
					$new[$i]['created_at']  = $value['created_at'];
					$new[$i]['updated_at']  = $value['updated_at'];
					
					$i++;
				}	

			return $new;
		}


		public function valid_url($url){

		return (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url))?false:true; 

		}


		public function add_http($url){
	    return (!preg_match("~^(?:f|ht)tps?://~i", $url))?"http://".$url:$url;
		}



}