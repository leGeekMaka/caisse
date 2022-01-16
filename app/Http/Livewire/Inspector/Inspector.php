<?php

namespace App\Http\Livewire\Inspector;

use App\Models\Employer;
use Livewire\Component;

class Inspector extends Component
{
    public
        $object,
        $message,
        $path,
        $control,
        $employeId
    ;
    public function render()
    {
        return view('livewire.inspector.inspector',[
            'inspectors' => Employer::where('status','En attente')
                                      ->where('responsible','<>',null)
                                      ->where('control',null)
                                      ->get()
        ]);
    }

    public function display($idEmploye){

        $employer = Employer::where('id', $idEmploye)->first();

        $this->object = $employer->object;
        $this->message = $employer->message;
        $this->control = $employer->control;
        $this->path = $employer->path;
        $this->employeId = $employer->id;
    }

    public function update(){

        Employer::find($this->employeId)->update([
            'control' => $this->control,
        ]);
    }

    public function cancel(){
        $this->reset('object','message','path','employeId');
    }
}
