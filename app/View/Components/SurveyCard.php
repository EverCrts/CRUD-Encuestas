<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SurveyCard extends Component
{
    public $name;
    public $description;
    public $miniature;

    public function __construct($name, $description, $miniature)
    {
        $this->name = $name;
        $this->description = $description;
        $this->miniature = $miniature;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.survey-card');
    }
}
