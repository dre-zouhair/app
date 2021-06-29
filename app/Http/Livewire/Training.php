<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use App\Models\Training as TrainingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use PHPUnit\Exception;

class Training extends Component
{
    public  $rules = [
        'title' => 'required',
        'startDate' => 'required|greater_than_field',
        'endDate' => 'required',
    ];
    public  $messages = [
        'title.required' => 'title field is required',
        'startDate.required'  => 'start date field is required',
        'startDate.greater_than_field'  => 'start Date should be < end date',
        'endDate.required' => 'end date field is required',
    ];
    public $trainings = [],$selected_id, $title,$startDate,$endDate;
    public $updateMode = false;



    public function render()
    {
        try{
        $this->trainings = Intern::findOrFail(Auth::user()->getAuthIdentifier())->trainings()->getResults();
        }catch (\Exception $e){
            $this->trainings = [];
        }
        return view('livewire.training');
    }

    public function store():void
    {
        $validatedDate = $this->validate();
        try{
            $training = TrainingModel::create([
                'intern_id' => Auth::user()->getAuthIdentifier(),
                'title' => $this->title,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ]);
            $this->resetInputFields();
            session()->flash('message', 'Training Has Been Created Successfully.');
        }catch (Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }


    }
    public function edit($id){

        $training = TrainingModel::findOrFail($id);
        $this->selected_id = $id;
        $this->title = $training->title;
        $this->startDate = $training->startDate;
        $this->endDate = $training->endDate;
        $this->updateMode = true;
        $this->render();
        $validatedDate = $this->validate([
            'title' => 'alpha-num'
        ]);
    }

    public function update()
    {
        $validatedDate = $this->validate();

        try {
            if ($this->selected_id) {
                $training = TrainingModel::all()->find($this->selected_id);
                $training->update([
                    'title' => $this->title,
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate,
                ]);
                $this->resetInputFields();
                $this->updateMode = false;
                session()->flash('message', 'Training Has Been Updated Successfully.');
            }
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function delete($id){
        try{
            TrainingModel::destroy($id);
            $this->render();
            session()->flash('message', 'Training Has Been deleted Successfully.');
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }
    public function cancelUpdate(){
        $validatedDate = $this->validate(['title'=>'alpha-num']);
        $this->resetInputFields();
        $this->updateMode = false;
    }
    private function resetInputFields(){
        $this->title = '';
        $this->startDate = '';
        $this->endDate = '';
    }
}
