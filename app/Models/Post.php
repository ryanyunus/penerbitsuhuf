<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content',
        'thumbnail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Biar route model binding pakai slug, bukan id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
