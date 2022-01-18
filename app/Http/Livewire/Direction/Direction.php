<?php

namespace App\Http\Livewire\Direction;


use App\Models\Employer;
use Illuminate\Support\Str;
use Livewire\Component;

class Direction extends Component
{
    public
        $object,
        $message,
        $path,
        $reason,
        $direction,
        $employeId
    ;

    public function render()
    {
        return view('livewire.direction.direction',[
            'directions' => Employer::where('status', config('status.pending'))
                                    ->where('direction',null)
                                    ->where('responsible','<>', null)
                                    ->where('control','<>', null)
                                    ->get()
        ]);
    }

    public function display($idEmploye){

        $employer = Employer::where('id', $idEmploye)->first();

        $this->object = $employer->object;
        $this->message = $employer->message;
        $this->direction = $employer->direction;
        $this->path = $employer->path;
        $this->reason = $employer->reason;
        $this->employeId = $employer->id;
    }

    public function update(){

        if ($this->direction === "validate")
        {
            Employer::find($this->employeId)->update([
                'direction' => $this->direction,
                'reason' => $this->reason,
                'status' => "validate",
                'token' => Str::random(7),
            ]);

            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Action enregistreé avec succès.');
        }

        if ($this->direction === "refuse")
        {
            Employer::find($this->employeId)->update([
                'direction' => $this->direction,
                'reason' => $this->reason,
                'status' => "refuse",
            ]);

            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Action enregistreé avec succès.');
        }
    }

    public function cancel(){
        $this->reset('object','message','path','employeId','reason');
    }
}
