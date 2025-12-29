<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{

    public function view(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff']);
    }

    public function viewAdminWidgets(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function viewStaffWidgets(User $user): bool
    {
        return $user->role === 'staff';
    }
}
