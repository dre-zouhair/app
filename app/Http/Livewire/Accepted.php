<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use Livewire\Component;

class Accepted extends Component
{
    public $accepted;

    public function render()
    {
        $this->accepted = Submission::where('state','=',true)->get()->sortDesc();
        return view('livewire.accepted');
    }
}
