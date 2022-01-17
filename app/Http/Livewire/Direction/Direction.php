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
            'directions' => Employer::where('status', 'En attente')
                                    ->where('direction',"")
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
                'status' => "accepté",
                'token' => Str::random(32),
            ]);
        }

        if ($this->direction === "refuse")
        {
            Employer::find($this->employeId)->update([
                'direction' => $this->direction,
                'reason' => $this->reason,
                'status' => "refusé",
            ]);
        }
    }

    public function cancel(){
        $this->reset('object','message','path','employeId','reason');
    }
}
