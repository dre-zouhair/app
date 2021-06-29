<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use App\Models\Skill as SkillModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PHPUnit\Exception;

class Skills extends Component
{
    public  $rules = [
        'label' => 'required',
    ];
    public  $messages = [
        'label.required' => 'title field is required',
    ];
    public $skills = [],$selected_id, $label;
    public $updateMode = false;



    public function render()
    {
        try{
            $this->skills = Intern::findOrFail(Auth::user()->getAuthIdentifier())->skills()->getResults();
        }catch (\Exception $e){
            $this->skills = [];
        }
        return view('livewire.skills');
    }

    public function store():void
    {
        $validatedDate = $this->validate();
        $label = $this->label;
        try{
            $skill = SkillModel::create([
                'intern_id' => Auth::user()->getAuthIdentifier(),
                'label' => $this->label,
            ]);
            $this->resetInputFields();
            session()->flash('message', $label.' has been created successfully.');
        }catch (Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }


    }
    public function edit($id){

        $skill = SkillModel::findOrFail($id);
        $this->selected_id = $id;
        $this->label = $skill->label;
        $this->updateMode = true;
        $this->render();
        $validatedDate = $this->validate([
            'label' => 'alpha-num'
        ]);
    }

    public function update()
    {
        $validatedDate = $this->validate();
        $label = $this->label;
        try {
            if ($this->selected_id) {
                $skill = SkillModel::all()->find($this->selected_id);
                $skill->update([
                    'label' => $this->label,
                ]);
                $this->resetInputFields();
                $this->updateMode = false;
                session()->flash('message', $label.' Has Been deleted Successfully.');
            }
        }catch (\Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }

    public function delete($id){
        try{
            $label = SkillModel::find($id)->label;
            SkillModel::destroy($id);
            $this->render();
            session()->flash('message', $label.' has been deleted Successfully.');
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
        $this->label = '';
        $this->selected_id = '';
    }
}
