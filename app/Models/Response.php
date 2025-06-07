<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'people_id',
        'survey_id',
        'question_id',
        'text_answer',
        'multiple_answers',
        'rating_answer',
        'ip_address',
        'user_agent',
        'responded_at',
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
