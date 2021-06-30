<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Submissions extends Component
{
    public $submissions;

    public function render()
    {
        $this->submissions = Intern::find(Auth::user()->getAuthIdentifier())->submissions()->getResults()->where('state','=',0)->get()->sortDesc();
        return view('livewire.submissions');
    }
}
