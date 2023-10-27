<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdmin extends Component
{

    public $permName, $permGuard = 'web';
    public $roleName, $rolePermission = [];

    public function render()
    {

        $permissions = Permission::all();
        return view('livewire.super-admin', [
            'permissions' => $permissions,
        ]);
    }
    public function addPermissions()
    {
        Permission::create([
            'name' => $this->permName,
            'guard' => $this->permGuard,
        ]);
        $this->dispatchBrowserEvent('hideModal');
        $this->resetData();
    }
    public function resetData()
    {
        $this->permName = null;
        $this->permGuard = null;
    }
    public function addRole()
    {
        Role::create([
            'name' => $this->roleName,
        ])->givePermissionTo([$this->rolePermission]);
        $this->dispatchBrowserEvent('hideModal');
        $this->resetData();
    }
    public function togglePermission($string)
    {
        $role = Role::where('name', 'admin')->first();
        if ($role) {
            if ($role->hasPermissionTo($string)) {
                $role->revokePermissionTo($string);
            } else {
                $role->givePermissionTo($string);
            }
        }
    }
}
