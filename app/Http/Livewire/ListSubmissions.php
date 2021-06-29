<?php

namespace App\Http\Livewire;

use App\Models\Field;
use App\Models\Internship;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListSubmissions extends Component
{

    public $internshipsList,$index=0,$submissions = [],$submission,$intern,$user,$desc,$lines;

    public $display = false,$paginate=false,$enterprise;
    public function render()
    {
        try{
            $this->enterprise = User::find(Auth::user()->getAuthIdentifier())->enterprise()->getResults();
            $this->internshipsList = $this->enterprise->internships()->getResults()->where('expirationDate' ,'>', \Carbon\Carbon::now())->sortDesc();
            $submissions = [];
            foreach ($this->internshipsList as $value){
                $submissions = array_merge($submissions,$value->submissions()->getResults()->where('state','=',0)->sortDesc()->toArray());
            }
            $data = $this->paginate ? $this->submissions = array_slice($submissions, $this->index , 5) : array_slice($submissions, 0, 5);
            if(sizeof($data)){
                $this->submissions = $data;
            }
            return view('livewire.list-submissions');
        }catch (\Exception $e){
            dd($e);
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
        ],[
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
    public function submission($id){
        try{
            $this->submission = Submission::find($id);
            $this->intern = $this->submission->intern()->getResults();
            $this->user = User::find($this->intern->id);
            $this->lines = explode("\n", $this->submission->desc);
            $this->display = true;
        }catch (\Exception $e){

        }

    }

    public function reject(){
        $this->submission->state = 2;
        $this->submission->save();
        $this->display = false;
    }

    public function accept(){
        $this->submission->state = 1;
        $this->submission->save();
        $this->display = false;
    }

    public function  close(){
        $this->display = false;
    }
}
