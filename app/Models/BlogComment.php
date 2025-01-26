<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A blog belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A blog can have many comments
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    // A blog can have many images
    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }

    // A blog can have many likes
    public function likes()
    {
        return $this->hasMany(BlogLike::class);
    }

    // A blog can have many shares
    public function shares()
    {
        return $this->hasMany(BlogShare::class);
    }
}
