<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Component
{

    public $permName, $permGuard = 'web', $role;
    public $roleName, $rolePermission = [];
    public $name, $email, $password;

    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('livewire.super-admin', [
            'permissions' => $permissions,
            'roles' => $roles,
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
        $this->name = null;
        $this->email = null;
        $this->password = null;
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
    public function createUser(){
        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = 1;
        $user->password = Hash::make($this->password);
        $user->save();
        $user->assignRole($this->role);
        $this->resetData();
        $this->dispatchBrowserEvent('hideModal');
    }
}
