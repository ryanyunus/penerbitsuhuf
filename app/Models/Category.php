<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // ← TAMBAHKAN INI

class Category extends Model
{
    use HasFactory;   // ← ini jadi pakai trait yang benar

    protected $fillable = [
        'name',
        'slug',
    ];
        public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
