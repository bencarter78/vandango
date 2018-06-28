<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_documents';

    /**
     * @var array
     */
    protected $fillable = ['organisation_id', 'uploaded_by', 'name', 'type', 'description', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
