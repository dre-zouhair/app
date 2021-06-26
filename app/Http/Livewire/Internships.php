<?php

namespace App\Http\Livewire;

use App\Models\Internship;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Internships extends Component
{
    public $internships,$internship,$desc;
    public $display = false,$modal= false;
    public function render()
    {
        try{
            $this->internships = Internship::where('expirationDate' ,'>', \Carbon\Carbon::now())->simplePaginate(5)->items();
            return view('livewire.internships');
        }catch (\Exception $e){

        }
    }

    public function internship($id){
        try{
            $this->internship = Internship::find($id);
            $this->display = true;
        }catch (\Exception $e){

        }

    }

    public function submit(){
        $this->modal = true;
    }

    public function save(){

        try{
            Submission::create([
                'desc' => $this->desc,
                'internship_id' => $this->internship->id,
                'intern_id' => Auth::user()->getAuthIdentifier()
            ]);
            $this->closeModal();
        }catch (\Exception $e){

        }

    }

    public function  close(){
        $this->display = false;
    }

    public function  closeModal(){
        $this->desc = '';
        $this->modal = false;
    }
}
