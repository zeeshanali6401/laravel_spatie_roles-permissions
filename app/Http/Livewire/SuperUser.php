<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperUser extends Component
{
    public function render()
    {
        $role = Role::findByName('admin');
        $permissions = $role->permissions->pluck('name');

        return view('livewire.super-user', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }
    public function togglePermission($string)
    {
        $role = Role::where('name', 'admin')->first();
        if ($role) {
            if ($role->hasPermissionTo($string)) {
                $role->revokePermissionTo($string); // Remove permission if already granted
            } else {
                $role->givePermissionTo($string); // Grant permission if not already granted
            }
        }
    }
}
