<?php

class Admin_SliderController extends \BaseController {

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
		 $this->file = 'slider';  
		$this->title = 'Slider'; 
		//Config::set('auth.model', 'Admin');
	}

	public function listAll($type=0,$id_theme=0,$page = 0 )  //  type  1 = news  / 2 releases, 3 campaigns
	{

		$this->section=$this->type_section($type);
	
		$data['file']		= $this->file;
		$data['title']		= $this->title;
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;
		$search = Input::get('search');
		$limit = (Input::get('limit'))?$limit = Input::get('limit'):$limit=10;
		$from = ($page-1)*$limit;
		$order = (Input::get('order'))?Input::get('order'):'id';
		$orderby = (Input::get('orderby'))?Input::get('orderby'):'desc';

		$data['type']     = $type;  //  1, 2 , 3 
		$data['section']  = $this->section;   //  news ,  campaigns , releases  		
		$data['id_theme'] = $id_theme;    //  id del item al que pertenece 

	 	$data['totalItems'] = Slider::count();
		$data['items'] = Slider::ListAll($type,$id_theme,$search, $order, $orderby)->paginate($limit);
	//  $data['items'] = Contact::ListAll($search, $order, $orderby)->paginate($limit)->toArray();

		return View::make('admin.slider.list', $data);
	}

	public function get_deleteItem($type=null,$id_item=null,$id = null ) {

		if($this->access->slider->delete) {
			$data['item']    = Slider::find($id);
			$data['type']    = $type;
			$data['id_item'] = $id_item;
		}
		return View::make('admin.slider.delete', $data);
	}

	public function post_deleteItem() {

		$id_item	= Input::get('id_item');
		$type	= Input::get('type');

		$idPost	= Input::get('id');
		$item	= Slider::find($idPost);
		if($this->access->slider->delete) {
			$item->delete();

			return Redirect::to('admin/'.$this->type_section($type).'/slider/'.$type.'/'.$id_item.'/list')->with('message_success', 'Item deleted success!');	
		}			
	}

		public function get_createItem($type=0,$id_theme=null) {

				$this->section=$this->type_section($type);

				$data['file']		= $this->file;
				$data['adminData']	= $this->adminData;
				$data['access']		= (!$this->access)?new stdClass():$this->access;
				$data['id_theme']   = $id_theme;
				$data['section']    = $this->section; 
				$data['type']       = $type;

				$data['title']		= 'Add Images';
				
				if($this->access->slider->create) {

				return View::make('admin.slider.form', $data);

					}	
			}

		public function post_createItem() {
			
			if($this->access->slider->create) {

				$file=Input::file(); 

				if($this->verify_array($file['news_slider'])){

					$type_int     = Input::get('type');
					$id_item      = Input::get('id_theme');
					$error_file   = 0;
					$success      = 'Image Uploaded success!';
					$error_slider = 'Try to upload images';
					$count        = 0;

					$type=$this->type_section(Input::get('type'));


					foreach ($file['news_slider'] as $key => $value) {	


									if(!empty($value)){

										$count++;

										if($value->getSize()<4194304){

													$slider = new Slider;

													$ext=explode(".", $value->getClientOriginalName());

													$image=$type."_slider_".rand(0,1000).time().".".$ext[count($ext)-1];   

													$slider->id_item 	  = $id_item;
													$slider->type_item 	  = $type_int;
													$slider->image        = $image;  
							
											        if($slider->save()){

											            $value->move(public_path().'/upload/'.$type.'/slider',$value->getClientOriginalName());

														$path=public_path().'/upload/'.$type.'/slider/';

											            rename($path.$value->getClientOriginalName(), $path.$image);
											          									        
											        }else{
											        	goto c;
											        }

												}else{
													$error_file++;
												}
									    }
								}	  

								$success=($error_file)?'Image Uploaded success!, but some images that exceeded 4 mb not saved':$success;

								if($count==$error_file){ $error_slider= "The limit for Images is 4 MB."; goto c;}

							return Redirect::to('admin/'.$type.'/slider/'.$type_int.'/'.$id_item.'/list')->with('message_success', $success);       

					 	   }else{

					    	c:
							 return Redirect::back()->with('message_error', $error_slider);
						}
					}			
			}


		public function get_visibleItem( $id = null ) {
			
			if($this->access->slider->edit) {
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

			$result= Slider::Findfile($file)->get()->first()->toArray();

		    if( (!empty($result))&&(is_file('./public/upload/contact/'.$result['file'].'.'.$result['file_type'])) ){

	        $file= public_path(). "/upload/contact/".$result['file'].'.'.$result['file_type'];

        	$headers = array(
              'Content-Type: application/'.$result['file_type'],
            );

	        return Response::download($file, $result['file'].'.'.$result['file_type'], $headers);
			 }
		}


			 private function get_id_youtube($url){
		        $u = parse_url($url);
			        if(!empty($u['query'])){
			        parse_str($u['query'], $t);
			        return $t["v"];
				    }else{
				    	return false; 
				    }
		    }

			public function get_viewItem($slider=null,$id = null ){

				$data['file']		= $this->file;
				$data['adminData']	= $this->adminData;
				$data['access']		= (!$this->access)?new stdClass():$this->access;
				$data['title']		= 'View '.$this->title;
				$data['view']		= '1';

				if($this->access->slider->view){

					$data['item'] = Slider::find($id);
					return View::make('admin.slider.form', $data);

				}
			}

			public function verify_array($array){

				foreach ($array as $key => $value) {
					if(!empty($value))
						return true;
					}
						return false;
		    	}


		   	public function type_section($t){

		   		$u=array('1'=>'news','2'=>'releases','3'=>'campaigns');

		   		return $u[$t];

		   	}

		   		public function exportAll($type=null,$id_item=null)
			{
				if($this->access->news->export) {

		 			$items = Slider::Getimages($type,$id_item)->get()->toArray(); 
		      		$space="          ";
			        $fields = array(
			            'id'          => 'Id '.$this->title.'_'.$this->type_section($type),
			            'image'		  => 'Name Image',
			            'created_at'   => 'Created At'         
			      	  );

			       		$query = array();
				        foreach ($items as $item)
				        {
					        $item = array(
								'id'          => $item['id'],
								'image'       => $item['image'],
								'created_at'  => $item['created_at']
					        );
					        $query[] = $item;
				        }

		     	   echo arrayToExcelDos($query, $fields, $this->title.'_'.$this->type_section($type));

			    }
		}

	public function get_sortingItem($type=0,$id_theme=0)  //  type  1 = news  / 2 releases, 3 campaigns
	{

		$this->section=$this->type_section($type);
	
		$data['file']		= $this->file;
		$data['title']		= $this->title;
		
		$data['adminData']	= $this->adminData;
		$data['access']		= (!$this->access)?new stdClass():$this->access;

		$data['type']     = $type;  
		$data['section']  = $this->section;   		
		$data['id_theme'] = $id_theme;   

		$data['items'] = Slider::Getimages($type,$id_theme)->get()->toArray(); 

		return View::make('admin.slider.sorting', $data);
	}


		public function post_sortingItem(){

			$type_int     = Input::get('type');
			$id_item      = Input::get('id_theme');
			$type=$this->type_section(Input::get('type'));

			$order=explode(',',Input::get('sort'));
			foreach ($order as $key => $value) {
				Slider::UpdatePosition($value,$key);
			}

				return Redirect::to('admin/'.$type.'/slider/'.$type_int.'/'.$id_item.'/list')->with('message_success', "Success!, successfully edited!");    
		
		}





}