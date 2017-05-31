<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Carrersjobs extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'carrers_jobs';


	public function scopeListAll($query, $search, $order, $orderby)
	{
		/*
		$query->select('carrers_jobs.id','carrers_jobs.title','carrers_areas.name AS area','carrers_jobs.description','carrers_jobs.created_at','carrers_jobs.visible','carrers_areas.id AS id_type','carrers_jobs.updated_at');
		$query->join('carrers_areas', 'carrers_jobs.type', '=', 'carrers_areas.id');
		$query->where('carrers_jobs.'.$order, 'LIKE', '%'.$search.'%');
		$query->orWhere('carrers_areas.name', 'LIKE', '%'.$search.'%');	
		if($order!='area'){
		$query->where('carrers_jobs.'.$order, 'LIKE', '%'.$search.'%'); }else{
		$query->where('carrers_areas.name', 'LIKE', '%'.$search.'%');}		
		$new_order=($order=="area")?'carrers_areas.name':'carrers_jobs.'.$order;
		$query->orderBy($new_order, $orderby);  */

		$query->where($order, 'LIKE', '%'.$search.'%');
		$query->orderBy($order, $orderby);

		return $query;
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
