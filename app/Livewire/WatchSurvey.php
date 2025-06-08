<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;


class WatchSurvey extends Component
{
    public $survey;

    public function mount($survey)
    {
        $this->survey = Survey::find($survey);
    }

    public function render()
    {
        return view('livewire.watch-survey', ['survey' => $this->survey])
            ->layout('layouts.app');
    }
}
