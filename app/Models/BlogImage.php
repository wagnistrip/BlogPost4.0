<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    use HasFactory;
    protected $table = 'blog_images';
    protected $fillable = [
        'blog_id','image_path','image_name'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
