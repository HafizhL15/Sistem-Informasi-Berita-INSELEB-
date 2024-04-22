<?php

namespace App\Models;

use App\Models\Positionads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function positionads()
    {
        return $this->belongsTo(Positionads::class);
    }
}
