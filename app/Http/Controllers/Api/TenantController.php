<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        $tenant = Tenant::create($request->all());
        $tenant->domains()->create([
            'domain' => $tenant->id . '.' . config('tenancy.central_domains')[0],
        ]);
        return $tenant;
    }

    public function index()
    {
        return Tenant::all();
    }
}
