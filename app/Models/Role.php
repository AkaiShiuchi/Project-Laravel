<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_name',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
