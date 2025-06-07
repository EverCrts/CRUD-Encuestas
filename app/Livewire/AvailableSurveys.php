<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Survey;

class AvailableSurveys extends Component
{
    public $surveys;

    public function mount()
    {
        $this->surveys = Survey::where('is_active', true)->get();
    }

    public function render()
    {
        return view('livewire.available-surveys');
    }
}
