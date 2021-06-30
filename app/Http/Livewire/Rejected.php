<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rejected extends Component
{
    public $rejected=[];
    public function render()
    {
        $this->rejected = Intern::find(Auth::user()->getAuthIdentifier())->submissions()->getResults()->where('state','=',2)->sortDesc();
        return view('livewire.rejected');
    }
}
