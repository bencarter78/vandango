<?php

namespace App\UserManager\Users;

use Carbon\Carbon;
use App\Exceptions\UserAccountException;

class Account
{
    /**
     * @var array|null
     */
    private $data;

    /**
     * @var User
     */
    private $user;

    /**
     * The number of months of probation
     *
     * @var int
     */
    private $probationPeriod = 6;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data = [])
    {
        $this->setData($data);
        $this->createUser();
        $this->createUserMeta();

        return $this->user;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return User
     */
    public function createUser()
    {
        $this->user = $this->user->create([
            'email' => $this->getEmail(),
            'username' => $this->getEmail(),
            'password' => $this->getPassword(),
            'first_name' => $this->data['first_name'],
            'surname' => $this->getSurname(),
            'activated' => true,
        ]);
    }

    /**
     * @return mixed
     * @throws UserAccountException
     */
    public function getEmail()
    {
        if ( ! filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new UserAccountException("The user account does not have a valid email address.");
        }

        return trim($this->data['email']);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return explode('@', strtolower($this->getEmail()))[0];
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return isset($this->data['password']) ? bcrypt($this->data['password']) : bcrypt(generatePassword());
    }

    /**
     * @return mixed
     * @throws UserAccountException
     */
    public function getSurname()
    {
        if ( ! (isset($this->data['surname']) || isset($this->data['last_name']))) {
            throw new UserAccountException("The user's surname was not set.");
        }

        return isset($this->data['surname']) ? $this->data['surname'] : $this->data['last_name'];
    }

    /**
     * @return void
     */
    public function createUserMeta()
    {
        return $this->user->meta()->save(new UserMeta([
            'tel' => isset($this->data['tel']) ? $this->data['tel'] : null,
            'mob' => isset($this->data['mob']) ? $this->data['mob'] : null,
            'start_date' => $this->getStartDate(),
            'probation_end_date' => $this->getProbationEndDate(),
        ]));
    }

    /**
     * @return mixed
     * @throws UserAccountException
     */
    public function getStartDate()
    {
        if ( ! isset($this->data['start_date']) || $this->data['start_date'] == '') {
            throw new UserAccountException("The user does not have a start date.");
        }

        if ($this->data['start_date'] instanceof Carbon) {
            return $this->data['start_date'];
        }

        return Carbon::parse(str_replace('/', '-', $this->data['start_date']));

    }

    /**
     * @return mixed
     */
    public function getProbationEndDate()
    {
        return $this->getStartDate()->copy()->addMonths($this->probationPeriod);
    }
}