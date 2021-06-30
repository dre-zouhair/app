<?php

namespace App\Http\Livewire;

use App\Models\Field;
use App\Models\Internship;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListInternships extends Component
{
    public $internshipsList,$index=0,$internships = [],$internship,$desc,$lines;
    public $display = false,$paginate=false,$enterprise,$update=false;
    public $title,$details,$startDate,$expirationDate,$duration;
    public $label,$fullName;
    public function render()
    {
        try{
            $this->enterprise = User::find(Auth::user()->getAuthIdentifier())->enterprise()->getResults();
            $this->internshipsList = $this->enterprise->internships()->getResults()->where('expirationDate' ,'>', \Carbon\Carbon::now())->sortDesc();
            $data = $this->paginate ? $this->internships = array_slice($this->internshipsList->toArray(), $this->index , 5) : array_slice($this->internshipsList->toArray(), 0, 5);
            if(sizeof($data)){
                $this->internships = $data;
            }
            return view('livewire.list-internships');
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function paginate($sign){
        $this->index += $sign * 5;
        $this->paginate = true;
    }

    public function createInternship(){

        Validator::make([
            'title' => $this->title,
            'details' => $this->details,
            'duration' => $this->duration,
            'startDate' => $this->startDate,
            'expirationDate' => $this->expirationDate,
            'label' => $this->label,
            'fullName' => $this->fullName
        ],
            [
            'title' => 'required',
            'details' => 'required',
            'duration' => 'required',
            'startDate' => 'required',
            'expirationDate' => 'required',
            'label' => 'required',
            'fullName' => 'required',
       ])->validate();

        $field = Field::create([
            'label' => $this->label,
            'fullName' => $this->fullName
        ]);

       Internship::create([
           'title' => $this->title,
           'details' => $this->details,
           'duration' => $this->duration,
           'startDate' => $this->startDate,
           'expirationDate' => $this->expirationDate,
           'enterprise_id' => $this->enterprise->id,
           'field_id' => $field->id
       ]);

        $this->clearData();
    }
    public function internship($id){
        try{
            $this->internship = Internship::find($id);
            $this->lines = explode("\n", $this->internship->details);
            $this->display = true;
            $this->update = false;
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function edit(){
        $this->update = true;
        $this->title = $this->internship->title;
        $this->details = $this->internship->details;
        $this->duration = $this->internship->duration;
        $this->startDate = $this->internship->startDate;
        $this->expirationDate = $this->internship->expirationDate;
        $this->label = $this->internship->field()->getResults()->label;
        $this->fullName = $this->internship->field()->getResults()->fullName;
    }

    public function update(){
        Validator::make([
            'title' => $this->title,
            'details' => $this->details,
            'duration' => $this->duration,
            'startDate' => $this->startDate,
            'expirationDate' => $this->expirationDate,
            'label' => $this->label,
            'fullName' => $this->fullName
             ],
            [
                    'title' => 'required',
                    'details' => 'required',
                    'duration' => 'required',
                    'startDate' => 'required',
                    'expirationDate' => 'required',
                    'label' => 'required',
                    'fullName' => 'required',
            ])->validate();

        $field = Field::find($this->internship->field()->getResults()->id)->update([
            'label' => $this->label,
            'fullName' => $this->fullName
        ]);

        Internship::find($this->internship->id)->update([
            'title' => $this->title,
            'details' => $this->details,
            'duration' => $this->duration,
            'startDate' => $this->startDate,
            'expirationDate' => $this->expirationDate,
        ]);
        $this->clearData();

    }
    private function clearData(){
        $this->title = '';
        $this->details = '';
        $this->duration = '';
        $this->startDate = '';
        $this->expirationDate = '';
        $this->enterprise->id = '';
        $this->label = '';
        $this->fullName = '';
    }
    public function cancel(){
        $this->display = false;
        $this->update = false;
        $this->clearData();
    }

    public function save(){
        try{
            Submission::create([
                'desc' => $this->desc,
                'internship_id' => $this->internship->id,
                'intern_id' => Auth::user()->getAuthIdentifier()
            ]);
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }
    }

    public function  close(){
        $this->display = false;
    }
}
