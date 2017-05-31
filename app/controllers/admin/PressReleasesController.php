<?php

class Admin_PressReleasesController extends \BaseController {

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
		$this->file = 'releases';  
		$this->title = 'Press Releases'; 
		//Config::set('auth.model', 'Admin');
	}

	public function listAll( $page = 0 )
	{

	
		$data['file']		= $this->file;
		$data['title']		= $this->title;
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$search = Input::get('search');
		$limit = (Input::get('limit'))?$limit = Input::get('limit'):$limit=10;
		$from = ($page-1)*$limit;
		$order = (Input::get('order'))?Input::get('order'):'id';
		$orderby = (Input::get('orderby'))?Input::get('orderby'):'desc';

		$data['type']=2;
		
	 	$data['totalItems'] = PressReleases::count();
		$data['items'] = PressReleases::ListAll($search, $order, $orderby)->paginate($limit);
	//  $data['items'] = Contact::ListAll($search, $order, $orderby)->paginate($limit)->toArray();

		return View::make('admin.releases.list', $data);
	}

	public function exportAll()
	{
		if($this->access->news->export) {

 			$items = PressReleases::all()->toArray();
      		$space="          ";

	        $fields = array(
	            'id'          => 'Id '.$this->title,
	            'title'		  => 'Title',
	            'sub_title'   => 'Sub Title',
	            'image' 	  => 'Image',
	            'description' => 'Description',
	            'video'		  => 'Video Youtube',
	            'date_event'  => 'Date Event',
	            'created_at'  => 'Created At'          
	      	  );

	        $query = array();
	        foreach ($items as $item)
	        {

				$y=explode(" ",$item['date_event']);

				$d=trim(strip_tags($item['description']));
				$description = str_replace('&nbsp;', '', $d);

		        $item = array(

					'id'          => $item['id'],
					'title'       => $item['title'],
					'sub_title'   => $item['sub_title'],
					'image'       => $item['image'],
					'description' => $description,
					'video'       => "https://www.youtube.com/watch?v=".$item['video'],
					'date_event'  => $y[0],  
					'created_at'  => $item['created_at']
		        );
		        $query[] = $item;
	        }

     	   echo arrayToExcelDos($query, $fields, 'Press_releases');

	    }

	}

	public function get_deleteItem( $id = null ) {
		if($this->access->releases->delete) {
			$data['item'] = PressReleases::find($id);
		}
		return View::make('admin.releases.delete', $data);
	}

	public function post_deleteItem() {
		$idPost	= Input::get('id');
		$item	= PressReleases::find($idPost);
		if($this->access->releases->delete) {
			$item->delete();
			return Redirect::to('admin/releases/')->with('message_success', 'Item deleted success!');
		}			
	}

	public function get_createItem() {

			$data['file']		= $this->file;
			$data['adminData']	= $this->adminData;
			$data['access']		= (!$this->access)?new stdClass():$this->access;
			$data['title']		= 'Create '.$this->title;
			
			if($this->access->releases->create) {
			
			$data['ckeditor']=true;

			return View::make('admin.releases.form', $data);

			}
		}

		public function post_createItem() {
			
			if($this->access->releases->create) {


				$file   = Input::file("image");
				$inputs = Input::all();
				$rules  = array( 
					'title' 			=> 'required|min:2|max:50',     //  unique:admin,user',
					'sub_title' 	    => 'required', 
					'description' 		=> 'required|min:4|max:1000',  //'email'=> 'required|email|min:4|max:255|unique:admin,email',	
				    'image'             => 'required|image|max:4096',	
					'video'             => 'required',	
					'date_event'        => 'required'
				);

				$messages = array(
	              'max' => 'The limit for Images is 4 MB.'
	            );

				$validate = Validator::make($inputs, $rules, $messages);
				if(!$validate->fails()){

					if($this->get_id_youtube(Input::get('video'))){

					$releases = new PressReleases;

					$ext=explode(".", Input::file("image")->getClientOriginalName());
					$image="releases_".rand(0,1000).time().".".$ext[count($ext)-1];   

					$releases->type 	    = '2';
					$releases->leng 	    = 'en';
					$releases->title 	    = Input::get('title');
					$releases->sub_title    = Input::get('sub_title');	
					$releases->description  = Input::get('description');
					$releases->date_event   = Input::get('date_event')." 00:00:00";
					$releases->image        = $image;  
					$releases->video        = ($this->get_id_youtube(Input::get('video')))?$this->get_id_youtube(Input::get('video')):NULL;   //  validar id youtube y no sea un texto
			
			        if($releases->save()){



			            $file->move(public_path().'/upload/releases',Input::file("image")->getClientOriginalName());

						$path=public_path().'/upload/releases/';

			            rename($path.Input::file("image")->getClientOriginalName(), $path.$image);
			          
			           	return Redirect::to('admin/releases/list')->with('message_success', 'Item created success!'); 
			        } 
			    }else{
					$message_error='Check your URL youtube';
			    	goto a;
	  		 	 }		
				}else{
					$message_error='Check your info';
					a:
					 return Redirect::back()->with('message_error', $message_error)->withErrors($validate);

				}
				
			}			
		}

/*
		public function get_visibleItem( $id = null ) {
			
			if($this->access->releases->edit) {
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
*/
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

/*
		public function get_download($file){

			$result= PressReleases::Findfile($file)->get()->first()->toArray();

		    if( (!empty($result))&&(is_file('./public/upload/contact/'.$result['file'].'.'.$result['file_type'])) ){

	        $file= public_path(). "/upload/contact/".$result['file'].'.'.$result['file_type'];

        	$headers = array(
              'Content-Type: application/'.$result['file_type'],
            );

	        return Response::download($file, $result['file'].'.'.$result['file_type'], $headers);
			 }
		}
*/

		 private function get_id_youtube($url){
	        $u = parse_url($url);
		        if(!empty($u['query'])){
		        parse_str($u['query'], $t);
		        return $t["v"];
			    }else{
			    	return false; 
			    }
	    }

			public function get_viewItem( $id = null ){

				$data['file']		= $this->file;
				$data['adminData']	= $this->adminData;
				$data['access']		= (!$this->access)?new stdClass():$this->access;
				$data['title']		= 'View '.$this->title;
				$data['view']		= '1';

				if($this->access->releases->view){

					$data['item'] = PressReleases::find($id);
					return View::make('admin.releases.form', $data);

				}
			}


		public function get_editItem( $id = null ) {
			$data['file']		= $this->file;
			$data['adminData']	= $this->adminData;
			$data['access']		= (!$this->access)?new stdClass():$this->access;
			$data['title']		= 'Edit '.$this->title;

			if($this->access->releases->edit){

				$data['item'] = PressReleases::find($id);
				$data['item']['access'] = unserialize($data['item']['access']);
				$data['ckeditor']=true;

				return View::make('admin.releases.form', $data);
			}
		}

			public function post_editItem() {
				
				if($this->access->releases->edit) {

					$idPost	= Input::get('id');
					$releases = PressReleases::find($idPost);
					
					$image=Input::file("image");
					$edited_image=Input::get("edited_image");

					$file   = Input::file("image");
					$inputs = Input::all();
					$rules  = array( 
						'title' 			=> 'required|min:2|max:50',     //  unique:admin,user',
						'sub_title' 	    => 'required', 
						'description' 		=> 'required|min:4|max:1000',  //'email'=> 'required|email|min:4|max:255|unique:admin,email',	
						'video'             => 'required',	
						'date_event'        => 'required',
					);

					$validate = Validator::make($inputs, $rules);
					if(!$validate->fails()){

						if($this->get_id_youtube(Input::get('video'))){

							if((empty($image)) && ($edited_image=="")){
								$message_error='Image required!';
				    			goto a;
							}

							if(($edited_image=="")&&($file->getSize()>4194304)){
						    	$error='The limit for Images is 4 MB.';
							    goto a;
							}
							
						if(($edited_image)==""){

						$ext=explode(".", Input::file("image")->getClientOriginalName());
						$image="releases_".rand(0,1000).time().".".$ext[count($ext)-1]; 

						}else{

						$image=$edited_image;

							}
						$releases->type 	    = '2';
						$releases->leng 	    = 'en';
						$releases->title 	    = Input::get('title');
						$releases->sub_title    = Input::get('sub_title');	
						$releases->description  = Input::get('description');
						$releases->date_event   = Input::get('date_event')." 00:00:00";
						$releases->image        = $image;  
						$releases->video        = ($this->get_id_youtube(Input::get('video')))?$this->get_id_youtube(Input::get('video')):NULL;   //  validar id youtube y no sea un texto
				
				        if($releases->save()){

			        		if($edited_image==""){

				            $file->move(public_path().'/upload/releases',Input::file("image")->getClientOriginalName());

							$path=public_path().'/upload/releases/';

				            rename($path.Input::file("image")->getClientOriginalName(), $path.$image);
				          
				           	return Redirect::to('admin/releases/list')->with('message_success', 'Item edited success!'); 

				        	}					          
				           	return Redirect::to('admin/releases/list')->with('message_success', 'Item edited success!'); 
				        } 
					    }else{
							$message_error='Check your URL youtube';
					    	goto a;
			  		 	 }		
					}else{
						$message_error='Check your info';
						a:
						 return Redirect::back()->with('message_error', $message_error)->withErrors($validate);

					}

				}		

			}

}