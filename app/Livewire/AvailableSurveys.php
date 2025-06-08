<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Survey;
use Livewire\WithPagination;

class AvailableSurveys extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.available-surveys', [
            'surveys' => Survey::where('is_active', true)
                ->latest()
                ->paginate(3)
        ]);
    }
}
