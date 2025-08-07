<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    public function viewAdminDashboard(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function viewClientDashboard(User $user): bool
    {
        return $user->role === UserRole::Client;
    }
}
