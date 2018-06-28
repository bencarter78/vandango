<?php

use App\Judi\Models\Role;

$factory->define(Role::class, function () {
    return factory(\App\UserManager\Roles\Role::class)->make()->toArray();
});
