<?php

namespace App\UserManager\Sectors;

use App\Core\BaseModel;
use App\UserManager\Users\User;
use Laracasts\Presenter\PresentableTrait;
use App\UserManager\Departments\Department;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends BaseModel
{
    use SoftDeletes, PresentableTrait;

    /**
     * @var string
     */
    protected $presenter = SectorPresenter::class;

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'department_id'];

    /**
     * @var string
     */
    protected $table = 'data_sectors';

    /**
     * @var array
     */
    protected $appends = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_sectors');
    }

    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        return "[$this->code] $this->name";
    }

}