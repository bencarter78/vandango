<?php namespace App\Events\UserManager;

use App\Events\Event;
use App\UserManager\Users\User;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event {

	use SerializesModels;

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var array
	 */
	private $data;

	/**
	 * @var null
	 */
	private $password;

	/**
	 * Create a new event instance.
	 *
	 * @param User  $user
	 * @param array $data
	 * @param null  $password
	 */
	public function __construct( User $user, $data = [ ], $password = null )
	{
		$this->user     = $user;
		$this->data     = $data;
		$this->password = $password;
	}

	/**
	 * @return null
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

}
