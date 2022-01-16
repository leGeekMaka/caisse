<?php

namespace App\Http\Livewire\Employer;

use App\Models\Employer as ModelsEmployer;
use Livewire\Component;
use Livewire\WithFileUploads;

class Employer extends Component
{
    use WithFileUploads;
    public $object, $message, $status, $path, $fileName;
    const STATUS_1 = "En attente", STATUS_2 = "Accepté";
    public function render()
    {
        return view('livewire.employer.employer', [
            'employers' => ModelsEmployer::all(),
        ]);
    }

    protected $listeners = ['postAdded' => 'incrementPostCount'];

    public $rules = [
        'object' => 'required',
        'message' => 'required',
    ];
    public function store(){

      //  $path = $this->path->store('paths') ;
        $this->validate();
        ModelsEmployer::create([
            'object' => $this->object,
            'message' => $this->message,
            'path' => 'test',
            'fileName' => 'test',
            'status' => Self::STATUS_1,
        ]);

        $this->object = "";
        $this->message = "";
        
        session()->flash('message', 'Démande enregistreé avec succès.');
        $this->emit('closeModal');
        $this->dispatchBrowserEvent('closeAlert');
    }

    public function cancel(){
        $this->object = "";
        $this->message = "";
        $this->resetErrorBag();
    }
}
