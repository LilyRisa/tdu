<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phongban extends Model
{
    use HasFactory;

    public function chucvu()
    {
        return $this->belongsTo(chucvu::class, 'chucvu_id');
    }
}
