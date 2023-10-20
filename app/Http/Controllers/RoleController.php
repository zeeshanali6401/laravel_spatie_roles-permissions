<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role_form', compact('roles', 'permissions'));
    }

    public function store(Request $request){
        $adminRole = Role::create(['name' => $request->name]);
        $adminRole->givePermissionTo([$request->permission]);
        return redirect()->back();
    }
}
