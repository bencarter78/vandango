<?php namespace App\Events\UserManager;

use App\Events\Event;
use App\UserManager\Users\User;
use Illuminate\Queue\SerializesModels;

class UserWasUpdated extends Event {

	use SerializesModels;

	/**
	 * @var
	 */
	private $command;

	/**
	 * @var User
	 */
	private $user;

	/**
	 * Create a new event instance.
	 *
	 * @param User $user
	 * @param      $command
	 */
	public function __construct( User $user, $command )
	{
		$this->command = $command;
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getCommand()
	{
		return $this->command;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

}
