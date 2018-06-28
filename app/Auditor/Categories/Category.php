<?php

namespace App\Auditor\Categories;

use App\Auditor\Tasks\Task;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'auditor_categories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'color'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
