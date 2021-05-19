<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class examinfo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Teacher_id', 'Course', 'question_lenth','uniqueid','time',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'Teacher_id');
    }
}
