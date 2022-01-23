<?php

namespace App\Http\Livewire\Cashier;

use App\Models\Employer;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Cashier as ModelCashier;
class Cashier extends Component
{

    public $amount, $object, $name,$employeId,$token, $ispaid, $balance;

    public function mount(){
        $this->balance = ModelCashier::whereDay('created_at', date('d'))->sum('amount');
    }

    public function render()
    {
        return view('livewire.cashier.cashier',[
            'requests' => Employer::where('cashier',null)
                                   ->where('direction','validate')
                                   ->get(),
            'outflows' => Employer::where('cashier','validate')
                                    ->where('token','<>', null)
                                    ->where('isPaid',null)
                                    ->get(),
            'paids' => Employer::where('cashier','validate')
                                 ->where('token','<>', null)
                                 ->where('isPaid','=','oui')
                                 ->get(),

        ]);
    }

    public function getId($id){

        $employer = Employer::where('id', $id)->first();
        $this->name = "alex";
        $this->object = $employer->object;
        $this->amount = $employer->amount;
        $this->employeId = $employer->id;
        $this->token =  $employer->token ?? " ";
    }

    public function cancel()
    {
        $this->reset('name','object','amount');
    }

    public function generateToken(){

        Employer::find($this->employeId)->update([
            'cashier' => "validate",
            'token' => Str::random(7),
        ]);

        $this->emit('closeModal');
        $this->dispatchBrowserEvent('closeAlert');
        session()->flash('message', 'Décaissement validé.');
        $this->reset('name','object','amount','token');
    }

    public function paid(){

        ModelCashier::find(1)->update([
            'amount' => $this->balance - $this->amount
        ]);
        Employer::find($this->employeId)->update(['isPaid' => 'oui']);

        $this->balance = $this->balance - $this->amount;

        $this->emit('closeModal');
        $this->dispatchBrowserEvent('closeAlert');
        session()->flash('message', 'Décaissement validé.');
        $this->reset('name','object','amount','token');
    }
}
