<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'ip_address',
        'completed_at',
    ];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

}
