<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roleadmin extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function artikel()
    {
        return $this->hasMany(Article::class);
    }

    // public function roleadmin()
    // {
    //     return $this->belongsTo(Roleadmin::class, 'role_id');
    // }
}
