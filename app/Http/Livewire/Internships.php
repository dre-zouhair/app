<?php

namespace App\Http\Livewire;

use App\Models\Internship;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Internships extends Component
{
    public $internshipsList,$index=0,$internships = [],$internship,$desc,$lines;
    public $display = false,$modal= false,$paginate=false;

    public function render()
    {
        try{
            $this->internshipsList = Internship::where('expirationDate' ,'>', \Carbon\Carbon::now())->get()->sortDesc();
            $data = $this->paginate? $this->internships = array_slice($this->internshipsList->toArray(), $this->index , 5) : array_slice($this->internshipsList->toArray(), 0, 5);
            if(sizeof($data)){
                $this->internships = $data;
            }
            return view('livewire.internships');
        }catch (\Exception $e){

        }
    }

    public function paginate($sign){
        $this->index += $sign * 5;
        $this->paginate = true;
    }

    public function internship($id){
        try{
            $this->internship = Internship::find($id);

            $this->lines = explode("\n", $this->internship->details);
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
