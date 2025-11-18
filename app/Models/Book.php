<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'cover',
        'file','category_id',
        'title',
        'slug',
        'author',
        'isbn',
        'price',
        'cover',
        'description',
        'is_featured',
        'published_at',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
