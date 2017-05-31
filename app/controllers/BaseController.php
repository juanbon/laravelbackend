<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function getSocialMedia()
	{

		$tw = json_decode(file_get_contents(url().'/twitter/twitter.php'));

		$i=0;
		$arrayTW = array();

		if(empty($tw[0]->errors)){

				if(!empty($tw[0])){

				foreach ($tw as $key => $value) {

						$arrayTW[$i]['type'] = 'tw';
						$arrayTW[$i]['text'] = $value[0]->text;
						$arrayTW[$i]['pic'] = $value[0]->user->profile_image_url_https;
						$arrayTW[$i]['date'] = date("d/m/Y", strtotime($value[0]->created_at));
						$arrayTW[$i]['name'] = $value[0]->user->name;
						$arrayTW[$i]['username'] = '@' . $value[0]->user->screen_name;
						$arrayTW[$i]['favorites'] = $value[0]->favorite_count;
						$arrayTW[$i]['retweets'] = $value[0]->retweet_count;
						$i++;		
				}
			}
		}		

		//fb intacto
		$sites_fb=array('paletapayaso.us','bubulubu.us','Speedsters.us','kranky.us','dulcesvero.usa');

		$i=0;

		foreach ($sites_fb as $key => $value) {

			$fb = file_get_contents('https://graph.facebook.com/'.$value.'/posts?fields=message,picture,likes,shares,from,created_time&access_token=549613935140266|cO-RjRUq1ifta3Qb28fnjvbPICU&limit=1');
			
			$fb_decode = json_decode($fb);

			$fb_decode=(!empty($fb_decode->data[0]->message))?$fb_decode:$this->aux_data_fb($value);

			$data_fb[$i]=$fb_decode;
			$i++;
			
		}


		if(!empty($data_fb)){

		foreach ($data_fb as $key1 => $value1) {

			foreach ($value1->data as $key2 => $value2){

						if ( property_exists($value2, 'message') ) {
								$arrayTW[$i]['type'] = 'fb';
								$arrayTW[$i]['text'] = $value2->message;
								$arrayTW[$i]['pic'] = (property_exists($value2,'picture'))?$value2->picture:'';
								$arrayTW[$i]['date'] = date("d/m/Y", strtotime($value2->created_time));
								$arrayTW[$i]['name'] = $value2->from->name;
								$arrayTW[$i]['username'] = $value2->from->id;
							    $arrayTW[$i]['likes'] = (!empty($value2->likes))?count($value2->likes->data):0;	
								$arrayTW[$i]['share'] = (property_exists($value2,'shares'))?$value2->shares->count:0;
								$i++;	
							}
					  }
				}
			}

		$sorted = $this->array_order_by($arrayTW, 'date', SORT_DESC);
		return $sorted;
	}

	public function index() {
		 $data['socialMedia'] = $this->asignar_pos($this->getSocialMedia());
		return View::make('home', $data);
	}

    private function array_order_by()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp[$field] = array();
                foreach ($data as $key => $row)
                    $tmp[$field][$key] = $row[$field];
                $args[$n] = &$tmp[$field];
            } else {
                $args[$n] = &$args[$n];
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    private function asignar_pos($array){

    	$pos=0;

  		$data=array("1"=>"190","110","140","160","120","999","888");

    	$fb=0;         
    	$tw=0;
    	$pos_fb=array('1','3','4','6','7');
    	$pos_tw=array('2','5');

    	shuffle($pos_fb);
    	shuffle($pos_tw);

    	foreach ($array as $key => $value) {

    		if($value["type"]=="fb"){

    			$array[$pos]['position']=$pos_fb[$fb];
    			$array[$pos]['data']=$data[$pos_fb[$fb]];
    			$fb++;

    		}else{
    			$array[$pos]['position']=$pos_tw[$tw];
    			$array[$pos]['data']=$data[$pos_tw[$tw]];
    			$tw++;
    		}

    		$pos++;
    		 
    	}

    	return $array; 

    }


    public function aux_data_fb($val){

			$fb = file_get_contents('https://graph.facebook.com/'.$val.'/posts?fields=message,picture,likes,shares,from,created_time&access_token=549613935140266|cO-RjRUq1ifta3Qb28fnjvbPICU&limit=10');

			$e=json_decode($fb);

			foreach ($e->data as $key => $value) {

			 	if(property_exists($value, 'message')){

			 		$object = new stdClass();
			 		$object->data[0]=$value;
					return $object;
				 }
			} 
			return false; 
	 }

}
