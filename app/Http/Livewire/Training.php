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
    // This array contains the validation rules for some inputs
    public  $rules = [
        'title' => 'required',
        'startDate' => 'required|greater_than_field',
        'endDate' => 'required',
    ];
    // This array contains the error messages for each validation rule
    public  $messages = [
        'title.required' => 'title field is required',
        'startDate.required'  => 'start date field is required',
        'startDate.greater_than_field'  => 'start Date should be < end date',
        'endDate.required' => 'end date field is required',
    ];
    //This vars/attributes are the state of the component, i.e they store the data of the component
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
        // this methode is used to store a Training
        // it will be executed when triggered from the component
        // we validate the input

        $this->validate();

        try{
            // create a training
            TrainingModel::create([
                'intern_id' => Auth::user()->getAuthIdentifier(),
                'title' => $this->title,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ]);
            //reset the inputs to initial values (No wan wants to see their form's data after clicking submit
            $this->resetInputFields();
            session()->flash('message', 'Training Has Been Created Successfully.');
        }catch (Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }


    }
    public function edit($id){

        // when we want to edit a Training we first fill the fields with data the old data
        // we set updateMode to true as this variable is used in the view to display the edit form or not
        $training = TrainingModel::findOrFail($id);
        $this->selected_id = $id;
        $this->title = $training->title;
        $this->startDate = $training->startDate;
        $this->endDate = $training->endDate;
        $this->updateMode = true;
        $this->render();
    }

    public function update()
    {
        // we validated the data
        $validatedDate = $this->validate();

        try {
            // check if we have a selected id to be updated
            if ($this->selected_id) {
                // grab the respective Training for the id
                $training = TrainingModel::all()->find($this->selected_id);
                // update the training  using the fields that are mapped in the view
                $training->update([
                    'title' => $this->title,
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate,
                ]);
                // reset the form (same thing as always )
                $this->resetInputFields();
                // updateMode to false to hide the edit form
                $this->updateMode = false;
                session()->flash('message', 'Training Has Been Updated Successfully.');
            }
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function delete($id){
        // this one is obvious
        try{
            TrainingModel::destroy($id);
            $this->render();
            session()->flash('message', 'Training Has Been deleted Successfully.');
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }
    public function cancelUpdate(){
        // to cancel update ( mapped to the cancel button in the edit form )
        $validatedDate = $this->validate(['title'=>'alpha-num']);
        $this->resetInputFields();
        $this->updateMode = false;
    }

    /**
     * reset the fields wich are used for create and update
     */
    private function resetInputFields(){
        $this->title = '';
        $this->startDate = '';
        $this->endDate = '';
    }
}
