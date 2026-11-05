<?php

namespace App\Models;

use App\Support\PostHtmlSanitizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Sanitize rich-text bodies on write so unsafe markup is never persisted.
     */
    public function setBodyAttribute(?string $value): void
    {
        $this->attributes['body'] = PostHtmlSanitizer::clean($value);
    }

    /**
     * Sanitize rich-text bodies on read as a safety net for legacy records.
     */
    public function getBodyAttribute(?string $value): string
    {
        return PostHtmlSanitizer::clean($value);
    }

    public function isLikedByUser(): bool
    {
        if (array_key_exists('is_liked_by_user', $this->attributes)) {
            return (bool) $this->attributes['is_liked_by_user'];
        }

        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    /**
     * Get the time ago attribute for the post.
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
