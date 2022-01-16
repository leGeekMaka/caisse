<?php

namespace App\Http\Livewire\Responsible;

use App\Models\Employer;
use Livewire\Component;

class Responsible extends Component
{
    public
          $object,
          $message,
          $path,
          $reason,
          $responsible,
          $status,
          $employeId
          ;

    public function render()
    {
        return view('livewire.responsible.responsible', [
            'responsibles' => Employer::where('status','En attente')
                                        ->where('responsible',null)
                                        ->get(),
        ]);
    }

    public function display($idEmploye){

        $employer = Employer::where('id', $idEmploye)->first();

        $this->object = $employer->object;
        $this->message = $employer->message;
        $this->reason = $employer->reason;
        $this->status = $employer->status;
        $this->responsible = $employer->responsible;
        $this->path = $employer->path;
        $this->employeId = $employer->id;

    }

    public function update(){

        if ($this->responsible === "refuse")
        {
            Employer::find($this->employeId)->update([
                'reason' => $this->reason,
                'responsible' => $this->responsible,
                'status' => "refused",
            ]);
        }


        if ($this->responsible === "validate")
        {
            Employer::find($this->employeId)->update([
                'reason' => $this->reason,
                'responsible' => $this->responsible,
            ]);
        }

    }
    public function cancel(){
        $this->reset('object','message','reason','responsible','path','status','employeId');

    }
}
