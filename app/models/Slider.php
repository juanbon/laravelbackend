<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Slider extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slider';

//  	$data['items'] = Slider::ListAll($news,$type,$search, $order, $orderby)->paginate($limit);

	public function scopeListAll($query,$type, $news, $search, $order, $orderby)
	{

		$query->where('id_item',$news);
		$query->where('type_item', $type);
		$query->orderBy($order, $orderby);
		return $query;
	}

	
	public function  ScopeFindfile($query,$file){
	
	return $query->where('file', $file);

	}


	public function  ScopeGetimages($query,$type,$id_item){
	
	$query->where('type_item', $type);
	return $query->where('id_item', $id_item);

	}
	
	public function  ScopeUpdatePosition($query,$id,$order){
	
            $query->where('id', $id);
            $query->update(array('order' => $order));

	}


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
