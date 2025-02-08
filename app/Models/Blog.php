<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    protected $fillable = [
                             'user_id ','category_id','title','sub_title','short_description','description','slug','status',
                             'view_count','comment_count','seo_title','seo_description','seo_keywords','like_count','share_count'
                ];

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
