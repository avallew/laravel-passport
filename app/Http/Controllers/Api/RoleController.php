<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        return Role::create($request->all());
    }

    public function permissionsToRole(Role $role, Request $request)
    {
        $role->permissions()->sync($request->permissions);
    }

    public function rolesToUser(User $user, Request $request)
    {
        $user->roles()->sync($request->roles);
    }
}
