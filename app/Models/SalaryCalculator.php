<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCalculator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'allowance',
        'allowance_other',
        'leave',
        'gross',
        'net',
        'actual_salary_received',
        'insurrance',
        'tax',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
