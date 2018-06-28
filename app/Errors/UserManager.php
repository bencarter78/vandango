<?php

// PasswordCheckFailureException
App::error(function (App\Exceptions\PasswordCheckFailureException $e) {
    return Redirect::back()->with('error', 'Sorry there was an error' . ' - ' . $e->getMessage());
});

// UserEmailAlreadyExistsException
App::error(function (App\Exceptions\UserEmailAlreadyExistsException $e) {
    return Redirect::back()->with('error', 'Sorry there was an error' . ' - ' . $e->getMessage());
});

// DepartmentExistsException
App::error(function (App\Exceptions\DepartmentExistsException $e) {
    return Redirect::back()->with('error', 'Sorry there was an error' . ' - ' . $e->getMessage());
});

// SectorCodeExistsException
App::error(function (App\Exceptions\SectorCodeExistsException $e) {
    return Redirect::back()->with('error', 'Sorry there was an error' . ' - ' . $e->getMessage());
});

// RoleExistsException
App::error(function (App\Exceptions\RoleExistsException $e) {
    return Redirect::back()->with('error', 'Sorry there was an error' . ' - ' . $e->getMessage());
});