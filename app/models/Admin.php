<?php

use Illuminate\Auth\UserInterface;


class Admin extends Eloquent implements UserInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin';

	public static $rules = array(
	    'user'=>'required|alpha_num|min:2',
	    'password'=>'required'
    );

	public function scopeListAll($query, $search, $order, $orderby)
	{
		$query->whereNotIn('id', array(1));
		$query->where($order, 'LIKE', '%'.$search.'%');
		$query->orderBy($order, $orderby);
		return $query;
	}


	public function  ScopeverifyUser($query,$user,$pass){
	
		   $query->where('user', $user);
	return $query->where('password', $pass);

	}


	public function  ScopeverifyJustUser($query,$user){
	
	return   $query->where('user', $user);
	
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