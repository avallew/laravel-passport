<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
        //     'name' => $request->name,
        //     'guard_name' => 'web'
        // ]);
        return $permission;
    }
}
