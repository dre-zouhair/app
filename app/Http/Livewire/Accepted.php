<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

// this class is used to load the needed data for the liveWire Accepted Component defined in the views folder
class Accepted extends Component
{
    public $accepted;

    /**
     * The method render is used to initialize the class attributes, which are accessible via the Component (View)
     * And it will be executed each time a variable value will change
     */
    public function render()
    {
        // load accepted submission
        // then return the Component ( a Component is a vue that is mapped to a Class)
        $this->accepted = Intern::find(Auth::user()->getAuthIdentifier())->submissions()->getResults()->where('state','=',1)->get()->sortDesc();
        return view('livewire.accepted');
    }
}
