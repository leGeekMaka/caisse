<?php

namespace App\Http\Livewire\Inspector;

use App\Models\Employer;
use Livewire\Component;

class Inspector extends Component
{
    public
        $object,
        $amount,
        $path,
        $control,
        $employeId,
        $fileName,
        $name = "false"
    ;
    public function render()
    {
        return view('livewire.inspector.inspector',[
            'inspectors' => Employer::where('status',config('status.pending'))
                                      ->where('responsible','<>',null)
                                      ->where('control',null)
                                      ->get(),
             'validatedControls' => Employer::where('responsible','<>',null)
                                      ->where('control','<>',null)
                                      ->get(),
             'controlsRefused' => Employer::where('status',config('status.refuse'))
                                      ->where('responsible','<>',null)
                                      ->where('control','<>',null)
                                      ->get(),

        ]);
    }

    public function display($idEmploye){

        $employer = Employer::where('id', $idEmploye)->first();
        $this->name = "true";
        $this->object = $employer->object;
        $this->amount = $employer->amount;
        $this->control = $employer->control;
        $this->path = $employer->path;
        $this->fileName = $employer->fileName;
        $this->employeId = $employer->id;
    }

    public function update(){

        Employer::find($this->employeId)->update([
            'control' => $this->control,
        ]);
        $this->name = "false";

        $this->emit('closeModal');
        $this->dispatchBrowserEvent('closeAlert');
        session()->flash('message', 'Action enregistreé avec succès.');
    }

    public function cancel(){
        $this->reset('object','amount','path','employeId');
        $this->name = "false";
    }
}
