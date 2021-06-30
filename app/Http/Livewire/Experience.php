<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use App\Models\Experience as ExperienceModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PHPUnit\Exception;

class Experience extends Component
{
    public  $rules = [
        'enterprise' => 'required',
        'desc' => 'required',
        'startDate' => 'required|greater_than_field',
        'endDate' => 'required',
    ];
    public  $messages = [
        'enterprise.required' => 'title field is required',
        'desc.required' => 'title field is required',
        'startDate.required'  => 'start date field is required',
        'startDate.greater_than_field'  => 'start Date should be < end date',
        'endDate.required' => 'end date field is required',
    ];
    public $experiences = [],$selected_id, $enterprise,$desc,$startDate,$endDate;
    public $updateMode = false;



    public function render()
    {
        try{
            $this->experiences = Intern::findOrFail(Auth::user()->getAuthIdentifier())->experiences()->getResults();
        }catch (\Exception $e){
            $this->experiences = [];
        }
        return view('livewire.experience');
    }

    public function store():void
    {
        $validatedDate = $this->validate();
        try{
            $experience = ExperienceModel::create([
                'intern_id' => Auth::user()->getAuthIdentifier(),
                'enterprise' => $this->enterprise,
                'desc' => $this->desc,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ]);
            $this->resetInputFields();
            session()->flash('message', 'Experience has been created successfully.');
        }catch (Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }


    }
    public function edit($id){

        $experience = ExperienceModel::findOrFail($id);
        $this->selected_id = $id;
        $this->enterprise = $experience->enterprise;
        $this->desc = $experience->desc;
        $this->startDate = $experience->startDate;
        $this->endDate = $experience->endDate;
        $this->updateMode = true;
        $this->render();
        $validatedDate = $this->validate([
            'enterprise' => 'alpha-num'
        ]);
    }

    public function update()
    {
        $validatedDate = $this->validate();

        try {
            if ($this->selected_id) {
                $experience = ExperienceModel::all()->find($this->selected_id);
                $experience->update([
                    'enterprise' => $this->enterprise,
                    'desc' => $this->desc,
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate,
                ]);
                $this->resetInputFields();
                $this->updateMode = false;
                session()->flash('message', 'Experience  has been created successfully.');
            }
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function delete($id){
        try{
            ExperienceModel::destroy($id);
            $this->render();
            session()->flash('message', 'Experience  has been deleted successfully.');
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }
    public function cancelUpdate(){
        $this->validate(['enterprise'=>'alpha-num']);
        $this->resetInputFields();
        $this->updateMode = false;
    }
    private function resetInputFields(){
        $this->enterprise = '';
        $this->desc = '';
        $this->startDate = '';
        $this->endDate = '';
    }
}
