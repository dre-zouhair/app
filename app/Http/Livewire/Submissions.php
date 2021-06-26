<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use Livewire\Component;

class Submissions extends Component
{
    public $submissions;

    public function render()
    {
        $this->submissions = Submission::where('state','=',false)->get()->sortDesc();
        return view('livewire.submissions');
    }
}
