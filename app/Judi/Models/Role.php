<?php

namespace App\Judi\Models;

use App\UserManager\Roles\Role as BaseRoleModel;

class Role extends BaseRoleModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'judi_role_process', 'role_id', 'process_id');
    }

} 