<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phucap extends Model
{
    use HasFactory;

    public function phongban()
    {
        return $this->belongsTo(phongban::class, 'phongban_id');
    }

    public function chucvu()
    {
        return $this->belongsTo(chucvu::class, 'chucvu_id');
    }
}
