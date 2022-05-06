<?php

namespace App\Models;

use App\Services\Article\MultiPageArticles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    use SoftDeletes, MultiPageArticles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'user_id',
    ];

    protected function getThumbnailAttribute($value): string
    {
        if (Storage::exists($value)) {
            return Storage::url($value);
        }

        return $value;
    }

    protected function getUrlAttribute(): string
    {
        return route('article.detail', $this->slug);
    }

    /**
     * Article belongs to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generateSlug(string $title, int $id = null): string
    {
        $count = self::query()
            ->where('id', '!=', $id)
            ->where('slug', Str::slug($title))
            ->count();

        if ($count > 0) {
            return Str::slug($title).'-'.$count;
        };

        return Str::slug($title);
    }
}
