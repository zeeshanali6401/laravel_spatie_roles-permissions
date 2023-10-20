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

        return view('livewire.super-user', [
            'roleCollection' => $roleCollection,
            'permissions' => $permissions,
        ]);
    }
    public function revoke($id){
        dd($id);
    }
}
