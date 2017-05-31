<?php

class Admin_UsuariosController extends \BaseController {

	private $access;
	private $adminData;
	private $file;
	private $title;

	public function __construct() 
	{
		$this->adminData = Session::get('adminInfo');  	
		$this->access = unserialize($this->adminData->access);  
		$this->file = 'usuarios';  
		$this->title = 'Usuarios'; 
		//Config::set('auth.model', 'Admin');
	}

	public function listAll( $page = 0 )
	{
		$data['file']		= $this->file;
		$data['title']		= $this->title;
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;

		
	 	$data['totalItems'] = Usuarios::count(); // $search, $order, $orderby


		$data['items'] 		= Usuarios::ListAll(null,null,'asc');
		
	

		$data['files']		= $this->file;	
	//  $data['items'] = Contact::ListAll($search, $order, $orderby)->paginate($limit)->toArray();

		return View::make('admin.'.$this->file.'.list', $data);
	}

	    
		public function get_deleteItem( $id = null ) {
			if($this->access->news->delete) {
				$data['item'] = Usuarios::find($id);
			}
			return View::make('admin.'.$this->file.'.delete', $data);
		}

		public function post_deleteItem() {
			$idPost	= Input::get('id');
			$item	= Usuarios::find($idPost);
			if($this->access->news->delete) {
				$item->delete();
				return Redirect::to('admin/'.$this->file.'/')->with('message_success', 'Item deleted success!');
			}			
		}

		public function get_createItem() {

				$data['file']		= $this->file;
				$data['adminData']	= $this->adminData;
				$data['access']		= (!$this->access)?new stdClass():$this->access;
				$data['title']		= 'Create '.$this->title;
				
				if($this->access->news->create) {
				
				$data['ckeditor']=true;

				return View::make('admin.'.$this->file.'.form', $data);

				}
			}

		public function post_createItem() {
			
			if($this->access->news->create) { //  si tiene acceso a create

				$inputs = Input::all();

/*
				var_dump($inputs);
				exit; 
*/
				$rules  = array( 
					'usuario' 	=> 'required|min:2|max:50',     //  unique:admin,user',
					'pass'  	=> 'required', 
				);

				$validate = Validator::make($inputs, $rules);

				if(!$validate->fails()){

					$news = new Usuarios;
 
					$news->user 	 = Input::get('usuario');
					$news->password  = md5("Phi".Input::get('pass'));

			        if($news->save()){

		           		return Redirect::to('admin/'.$this->file.'/list')->with('message_success', 'Item created success!'); 
			       
			        } 
		
				}else{

					$message_error='Check your info';

					return Redirect::back()->with('message_error', $message_error)->withErrors($validate);
				}		
			}			
		}

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


		public function get_editItem( $id = null ) {
			$data['file']		= $this->file;
			$data['adminData']	= $this->adminData;
			$data['access']		= (!$this->access)?new stdClass():$this->access;
			$data['title']		= 'Edit '.$this->title;

			if($this->access->news->edit){

				$data['item']           = Usuarios::find($id);
				$data['item']['access'] = unserialize($data['item']['access']);
				$data['ckeditor']       =true;

				return View::make('admin.'.$this->file.'.form', $data);
			}
		}



/*
			public function post_editItem() {
				
				if($this->access->news->edit) {

					$idPost       = Input::get('id');
					$news         = Usuarios::find($idPost);
					
					$image        = Input::file("image");
					$edited_image = Input::get("edited_image");

					$file         = Input::file("image");
					$inputs       = Input::all();
					$rules        = array( 
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
						$image="news_".time().".".$ext[count($ext)-1]; 

						}else{

						$image=$edited_image;

							}
						$news->type 	    = '1';
						$news->leng 	    = 'en';
						$news->title 	    = Input::get('title');
						$news->sub_title    = Input::get('sub_title');	
						$news->description  = Input::get('description');
						$news->date_event   = Input::get('date_event')." 00:00:00";
						$news->image        = $image;  
						$news->video        = ($this->get_id_youtube(Input::get('video')))?$this->get_id_youtube(Input::get('video')):NULL;   //  validar id youtube y no sea un texto
				
				        if($news->save()){

			        		if($edited_image==""){

				            $file->move(public_path().'/upload/news',Input::file("image")->getClientOriginalName());

							$path=public_path().'/upload/news/';

				            rename($path.Input::file("image")->getClientOriginalName(), $path.$image);
				          
				           	return Redirect::to('admin/'.$this->file.'/list')->with('message_success', 'Item edited success!'); 

				        	}					          
				           	return Redirect::to('admin/'.$this->file.'/list')->with('message_success', 'Item edited success!'); 
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

*/

}