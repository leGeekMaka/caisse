<?php

namespace App\Http\Livewire\Responsible;

use App\Models\Employer;
use Livewire\Component;

class Responsible extends Component
{
    public
          $object,
          $amount,
          $path,
          $reason,
          $responsible,
          $status,
          $employeId,
          $edit = "false"
          ;

    public function render()
    {
        return view('livewire.responsible.responsible', [
            'responsibles' => Employer::where('status',config('status.pending'))
                                        ->where('responsible',null)
                                        ->get(),
        ]);
    }

    public function display($idEmploye){

        $employer = Employer::where('id', $idEmploye)->first();

        $this->object = $employer->object;
        $this->amount = $employer->amount;
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
                'status' => "refuse",
            ]);

            $this->reset('object','amount','reason','responsible','path','status','employeId');
            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Démande enregistreé avec succès.');
        }


        if ($this->responsible === "validate")
        {
            Employer::find($this->employeId)->update([
                'reason' => $this->reason,
                'responsible' => $this->responsible,
            ]);

            $this->reset('object','amount','reason','responsible','path','status','employeId');
            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Démande enregistreé avec succès.');
        }

    }

    public function edit($employeId){
        $this->edit = "true";
        $employe = Employer::find($employeId);
        $this->reason = $employe->reason;
        $this->responsible = $employe->responsible;
        $this->employeId = $employe->id;
    }

    public function cancel(){
        $this->reset('object','amount','reason','responsible','path','status','employeId');

    }
}
