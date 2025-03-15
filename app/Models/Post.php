<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'title', 'body', 'image', 'category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the post.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

        public function isLikedByUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    
    /**
     * Get the time ago attribute for the post.
     *
     * @return string
     */
    public function getTimeAgoAttribute(): string
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 150); // Adjust the length as needed
    }
    
        // In Post.php model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
