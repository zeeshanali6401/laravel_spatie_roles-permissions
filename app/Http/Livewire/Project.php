<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Project as Projects;

class Project extends Component
{
    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'role' => 'required',
    ];
    public $name, $email, $password, $role;
    public $title, $description;
    public function render()
    {
        $collection = Projects::all();
        $roleCollection = Role::all();
        return view('livewire.project', [
            'collection' => $collection,
            'roleCollection' => $roleCollection,
        ]);
    }
    public function resetData(){
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
        $project->save();
        $this->dispatchBrowserEvent('hideModal');
        $this->render();
        $this->resetData();
    }
    public function edit($id)
    {
        dd($id);
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
    public function createUser(){
        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->email);
        $user->save();
        $user->assignRole($this->role);
        $this->resetData();
        $this->dispatchBrowserEvent('hideModal');
    }
}
