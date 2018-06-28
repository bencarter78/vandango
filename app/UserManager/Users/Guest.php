<?php

namespace App\UserManager\Users;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Guest extends Model
{
    use PresentableTrait;

    /**
     * @var
     */
    protected $presenter = UserPresenter::class;

    /**
     * @var array
     */
    protected $fillable = ['email', 'first_name', 'surname', 'company'];

    /**
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    /**
     * @param $value
     */
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucfirst($value);
    }
}
