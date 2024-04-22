<?php

namespace App\Models;


use App\Models\Tag;
use App\Models\Image;
use App\Models\Category;
use App\Models\Longtail;
use App\Models\Gambarartikel;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;


class Article extends Model implements Viewable
{
    use HasFactory, Sluggable, SoftDeletes, InteractsWithViews;

    protected $guarded = ['id'];

    protected $with = ['category', 'user', 'author'];

    protected $casts = ['published_at' => 'datetime:Y-m-d'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function longtails()
    {
        return $this->belongsToMany(Longtail::class);
    }

    public function gambarartikel()
    {
        return $this->belongsToMany(Gambarartikel::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    //Fungsi Cari Frontend
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhere('category_id', 'like', '%' . $search . '%');
        });
    }
}
