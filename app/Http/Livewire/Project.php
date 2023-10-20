<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project as Projects;

class Project extends Component
{
    public $title, $description;
    public function render()
    {
        $collection = Projects::all();

        return view('livewire.project', [
            'collection' => $collection
        ]);
    }
    public function resetData(){
        $this->title = null;
        $this->description = null;
    }
    public function store(){
        $project = new Projects;
        $project->title = $this->title;
        $project->description = $this->description;
        $project->save();
        $this->dispatchBrowserEvent('hideModal');
        $this->render();
        $this->resetData();
    }
    public function edit($id){
        dd($id);
    }
    public function delete($id){
        $data = Projects::find($id);
        if(!is_null($id)){
            $data->delete();
        }
        $this->render();
    }
}
