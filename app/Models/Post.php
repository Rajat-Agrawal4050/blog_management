<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'category',
        'short_description',
        'content',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
}
