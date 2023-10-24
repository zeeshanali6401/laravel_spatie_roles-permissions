<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Project as Projects;

class Project extends Component
{
    public $user, $name, $email, $password, $role, $perms = [];
    public $editPermission = [];
    public $title, $description;
    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'role' => 'required',
    ];
    public function render()
    {
        if (!is_null($this->role)) {
            $permissions = Role::where('name', $this->role)->first()->getAllPermissions();
        } else {
            $permissions = null;
        }
        if (auth()->user()->role == 'admin') {
            $collection = Projects::all();
        } else {
            $collection = Projects::where('user_id', auth()->user()->id)->get();
        }
        $userCollection = User::where('role', '!=', 'admin')->get();
        $roleCollection = Role::all();
        return view('livewire.project', [
            'collection' => $collection,
            'roleCollection' => $roleCollection,
            'permissions' => $permissions,
            'userCollection' => $userCollection,
        ]);
    }
    public function resetData()
    {
        $this->title = null;
        $this->description = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->role = null;
    }
    public function store()
    {
        $project = new Projects;
        $project->title = $this->title;
        $project->description = $this->description;
        $project->user_id = auth()->user()->id;
        $project->save();
        $this->dispatchBrowserEvent('hideModal');
        $this->render();
        $this->resetData();
    }
    public function edit($data)
    {
        $this->dispatchBrowserEvent('edit_modal');
        $user = User::find($data);
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->editPermission = $user->getAllPermissions();

    }
    public function update(){

    }
    public function delete($id)
    {
        $data = Projects::find($id);

        if (!is_null($id)) {
            if (auth()->user()->hasPermissionTo('delete')) {
                $data->delete();
            }
        } else {
            return "Error";
        }
        $this->render();
    }
    public function createUser()
    {
        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->password);
        $user->save();
        // $user->assignRole($this->role);
        $user->givePermissionTo($this->perms);
        $this->resetData();
        $this->dispatchBrowserEvent('hideModal');
    }
}
