<?php

Broadcast::channel('auditor.task.runner', function ($user) {
    return $user->hasAccess('auditorAdmin');
});