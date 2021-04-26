<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    use HasFactory;
    
    public function phongban()
    {
        return $this->hasMany(phongban::class, 'chucvu_id');
    }
}
