<?php

namespace App\Models;

use App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positionads extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function positionads()
    {
        return $this->belongsTo(Positionads::class);
    }

    public function ads()
    {
        return $this->hasMany(Ads::class);
    }
}
