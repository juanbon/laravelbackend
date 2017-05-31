<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PressReleases extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'press_releases';


	public function scopeListAll($query, $search, $order, $orderby)
	{

	//	dump($search, $order, $orderby);

		$query->where($order, 'LIKE', '%'.$search.'%');
		$query->orderBy($order, $orderby);
		return $query;

		/*
		$query->select('carrers_contact.id AS id_contact','carrers_contact.file_type','carrers_contact.email','carrers_areas.name AS type_job','carrers_contact.first_name AS contact_name','carrers_contact.city','carrers_contact.file','carrers_contact.last_name','states.description AS contact_state','carrers_contact.created_at AS contact_date');
	    $query->join('carrers_jobs', 'carrers_contact.id_carrers_job', '=', 'carrers_jobs.id');
		$query->join('carrers_areas', 'carrers_jobs.type', '=', 'carrers_areas.id');
		$query->join('states', 'states.id', '=', 'carrers_jobs.type');  	             
		$query->where('carrers_contact.first_name', 'LIKE', '%'.$search.'%');	
		$query->orWhere('carrers_contact.last_name', 'LIKE', '%'.$search.'%');	
		$query->orWhere('carrers_contact.email', 'LIKE', '%'.$search.'%');	
		$new_order=($order=="area")?'carrers_areas.name':'carrers_contact.'.$order;
		$new_order=($order=="state")?'states.description':'carrers_contact.'.$order;
		$query->orderBy($new_order, $orderby);                    
		return $query;      */

	}

	
	public function  ScopeFindfile($query,$file){
	
	return $query->where('file', $file);

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
