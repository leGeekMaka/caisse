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



    public $rules = [
        'object' => 'required',
        'message' => 'required',
    ];
    public function store(){

      //dd($this->path->getClientOriginalName());
      //$name = explode('.', $this->path->getClientOriginalName())[0];
      //dd($name);
      //$store = $this->path->store('attach');
      //dd($store);
        $this->validate();
        ModelsEmployer::create([
            'object' => $this->object,
            'message' => $this->message,
            'path' => $this->path ? $this->path->store('attach') : '',
            'fileName' => $this->path ? explode('.', $this->path->getClientOriginalName())[0] : '', // explode renvoi un tableau et j'affiche la premier élement du tableau
            'status' => Self::STATUS_1,
        ]);

        $this->object = "";
        $this->message = "";

        $this->emit('closeModal');
        $this->emit('fileUploaded');
        $this->dispatchBrowserEvent('closeAlert');
        session()->flash('message', 'Démande enregistreé avec succès.');
    }

    public function cancel(){
        $this->object = "";
        $this->message = "";
        $this->resetErrorBag();
    }
}
