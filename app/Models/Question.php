<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question',
        'type',
        'options', 
        'order',
        'is_required',
        'is_active',
        'is_anonymous',
        'is_multiple_choice',
        'is_single_choice',
        'is_text',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    protected static function booted()
    {
        static::creating(function ($question) {
            if(is_null($question->order) && $question->survey_id) {
                $max = Question::where('survey_id', $question->survey_id)->max('order');
                $question->order = $max !== null ? $max + 1 : 1;
            }
        });
    }
}
