<?php

namespace App\Helpers;

use App\Models\UserPermission;


function hasPermission($moduleId, $action)
{
    $user = auth()->user();

    if (!$user) {
        return false;
    }

    // Admin => all permissions
    if ($user->role === 'admin') {
        return true;
    }

    // Normal User => Check permissions
    return UserPermission::where('user_id', $user->id)
        ->where('module_id', $moduleId)
        ->where($action, 1)
        ->exists();
}
