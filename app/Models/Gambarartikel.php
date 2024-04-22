<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambarartikel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['name', 'slug'];

    public function artikel()
    {
        return $this->belongsToMany(Article::class);
    }
}
