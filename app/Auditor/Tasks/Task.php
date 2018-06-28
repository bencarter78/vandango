<?php

namespace App\Auditor\Tasks;

use App\Core\BaseModel;
use App\Models\EmailTemplate;
use App\Auditor\Categories\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'auditor_tasks';

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'sql',
        'group_by',
        'recipients',
        'reply_to',
        'template_id',
        'notification',
        'run_frequency',
        'ran_at',
    ];

    /**
     * @var array
     */
    protected $dates = ['ran_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(EmailTemplate::class);
    }

}