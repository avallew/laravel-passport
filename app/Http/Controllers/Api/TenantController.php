<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        $tenant = Tenant::create($request->all());
        $tenant->domains()->create([
            'domain' => $tenant->id . '.' . config('tenancy.central_domains')[0],
        ]);
        $userTenant = User::create($request->all());

        $permissions = Permission::all();
        // $role = Role::where('name', 'Administrador')->first();
        $tenant->run(function () use ($userTenant, $permissions) {
            $permission_ids = [];
            foreach ($permissions as $permission) {
                $permissionsCreated = Permission::create(['name' => $permission->name]);
                $permission_ids[] = $permissionsCreated->id;
            }
            $role = Role::create(['name' => 'AdministradorTenant']);
            $role->permissions()->attach($permission_ids);
            $role->users()->attach($userTenant->id);
            // $user = User::create($userTenant);
            // $userTenant->roles()->attach($role->id);
        });
        return $tenant;
    }

    public function index()
    {
        return Tenant::all();
    }
}
