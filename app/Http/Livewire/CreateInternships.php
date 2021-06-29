<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateInternships extends Component
{
    public  $internship,$lines;

    public function mount($internship,$lines)
    {
        $this->internship = $internship;
        $this->lines = $lines;
    }

    public function render()
    {
        return view('livewire.create-internships');
    }
}
