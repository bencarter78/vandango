<?php

namespace App\Portal;

use App\Core\BaseModel;

class PortalUserImports extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'portal_user_imports';

    /**
     * @var array
     */
    protected $fillable = ['portal_id'];

}