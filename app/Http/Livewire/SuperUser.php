<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperUser extends Component
{

    public function render()
    {
        $roleCollection = Role::all();

        $role = Role::findByName('admin');
        $permissions = $role->permissions;

        $permissionNames = $permissions->map(function ($permission) {
            return $permission->name;
        });

        return view('livewire.super-user', [
            'roleCollection' => $roleCollection,
            'permissions' => $permissionNames,
        ]);
    }
    public function togglePermission($id)
    {
        $role = Role::get();
        $role->revokePermissionTo('delete');
    }
}
