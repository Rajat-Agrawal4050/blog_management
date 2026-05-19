<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

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

      // ─── Scopes ───────────────────────────────────────────
    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

     // ─── Relationships ────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
}
