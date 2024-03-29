<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'description',
        'address',
        'start_contract',
        'chucvu_id',
        'phongban_id',
        'created_at',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chucvu()
    {
        return $this->belongsTo(chucvu::class, 'chucvu_id');
    }
    public function phongban()
    {
        return $this->belongsTo(phongban::class, 'phongban_id');
    }
    public function salary()
    {
        return $this->hasOne(salary::class);
    }
    public function salary_cal()
    {
        return $this->hasOne(salary::class);
    }
    public function examinfo()
    {
        return $this->hasOne(examinfo::class);
    }
    public function FaceRecognModel()
    {
        return $this->hasOne(FaceRecognModel::class);
    }
}
