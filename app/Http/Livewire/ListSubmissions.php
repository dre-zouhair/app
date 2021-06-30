<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListSubmissions extends Component
{

    public $internshipsList,$index=0,$submissions = [],$submission,$intern,$user,$desc,$lines;

    public $display = false,$paginate=false,$enterprise;
    public function render()
    {
        try{
            /**
             * we retrieve the user's (enterprise) then its internships using the ORM
             * \Carbon\Carbon::now() == Date::now
             */
            $this->enterprise = User::find(Auth::user()->getAuthIdentifier())->enterprise()->getResults();
            $this->internshipsList = $this->enterprise->internships()->getResults()->where('expirationDate' ,'>', \Carbon\Carbon::now())->sortDesc();
            $submissions = [];
            // for each internship we retrieve its submissions
            // then merge into the submissions array
            foreach ($this->internshipsList as $value){
                $submissions = array_merge($submissions,$value->submissions()->getResults()->where('state','=',0)->sortDesc()->toArray());
            }
            /**
             * the pagination logic:
             * if paginate ( a boolean ) then we slice 5 elements form $submissions - from $index to $index +5
             * else we slice 5 elements form $submissions - from 0 to 5
             *
             */
            $data = $this->paginate ? $this->submissions = array_slice($submissions, $this->index , 5) : array_slice($submissions, 0, 5);
            // if we have any data we assignee it to submissions as it will be used in the view/Component
            if(sizeof($data)){
                $this->submissions = $data;
            }
            return view('livewire.list-submissions');
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function paginate($sign){
        //this function is triggered form the viw to increment or decrement the index and activate the pagination
        $this->index += $sign * 5;
        $this->paginate = true;
    }

    public function submission($id){
        try{
            $this->submission = Submission::find($id);
            $this->intern = $this->submission->intern()->getResults();
            $this->user = User::find($this->intern->id);
            $this->lines = explode("\n", $this->submission->desc);
            $this->display = true;
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
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
