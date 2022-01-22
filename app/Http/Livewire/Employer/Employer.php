<?php

namespace App\Http\Livewire\Employer;

use App\Models\Employer as ModelsEmployer;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Employer extends Component
{
    use WithFileUploads;
    public $object, $message, $status, $path, $fileName,$employeId,$edit = "false", $token;
    public function render()
    {
        return view('livewire.employer.employer', [
            'employers' => ModelsEmployer::orderByDesc('created_at')->get(),
        ]);
    }

    protected $listeners = ['destroy'];

    public $rules = [
        'object' => 'required',
        'message' => 'required',
    ];
    public function store(){

        $this->validate();
        try{
            ModelsEmployer::create([
                'object' => $this->object,
                'message' => $this->message,
                'path' => $this->path ? $this->path->store('attach', 'public') : '',
                'fileName' => $this->path ? explode('.', $this->path->getClientOriginalName())[0] : '', // explode renvoi un tableau et j'affiche la premier élement du tableau
                'status' => config('status.pending'), //
            ]);

            $this->reset('object','message','path','fileName');
            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Démande enregistreé avec succès.');

        }catch(\Exception $e){

            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'oups une erreur est survenue, veuillez actualiser et essayer à nouveau.');
            $this->emit('closeModal');
            $this->reset('object','message','path','fileName');
        }
    }

    /**
     * @param $operationId
     */
    public function edit($operationId)  {
        $this->edit = "true";
        $employe = ModelsEmployer::find($operationId);
        $this->object = $employe->object;
        $this->message = $employe->message;
        $this->fileName = $employe->fileName;
        $this->employeId = $employe->id;
    }

    public function update(){

        try{
            ModelsEmployer::find($this->employeId)->update([
                'object' => $this->object,
                'message' => $this->message,
                'path' => $this->path ? $this->path->store('attach', 'public') : '',
                'fileName' => $this->path ? explode('.', $this->path->getClientOriginalName())[0]: '',
            ]);
            $this->edit = "false";
            $this->emit('closeModal');
            $this->dispatchBrowserEvent('closeAlert');
            session()->flash('message', 'Mise à jour reussie.');

        } catch(\Exception $e){
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'oups une erreur est survenue, veuillez actualiser et essayer à nouveau.');
            $this->emit('closeModal');
            $this->reset('object','message','path','fileName');
        }
    }


    /**
     * @param $operationId
     * on recupère l'id de l'operation à supprimer
     */
    public function getId($employeId){

        try{
            $employe = ModelsEmployer::find($employeId);
            $this->object = $employe->object;
            $this->employeId = $employe->id;
        }catch (\Exception $e){
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'oups une erreur est survenue, veuillez actualiser et essayer à nouveau.');
            $this->reset('object','employeId');
            $this->emit('closeModalDestroy');
        }
    }

    public function destroy(){

        try{
            ModelsEmployer::find($this->employeId)->delete();
            $this->reset('object') ;
        }catch (\Exception $e){
            Log::error(sprintf('%d'.$e->getMessage(), __METHOD__));
            session()->flash('error', 'oups une erreur est survenue, veuillez actualiser et essayer à nouveau.');
            $this->reset('object','employeId');
            $this->emit('closeModalDestroy');
        }
    }

    public function getToken($employeId){
        $employe = ModelsEmployer::find($employeId);
        $this->token = $employe->token;
    }

    public function previewPdf($id){
        $employe = ModelsEmployer::where('id',$id)->first();
        return response()->file();
    }
    public function cancel(){
        $this->object = "";
        $this->message = "";
        $this->resetErrorBag();
        $this->token = "";
    }
}
