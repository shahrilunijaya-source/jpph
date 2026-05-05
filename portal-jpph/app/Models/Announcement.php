<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnouncementFactory> */
    use HasFactory;

    protected $fillable = ['title_bm', 'title_en', 'excerpt_bm', 'excerpt_en', 'image_path', 'published_at', 'expires_at'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now())
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            });
    }

    public function title(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->title_en : $this->title_bm;
    }

    public function excerpt(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->excerpt_en : $this->excerpt_bm;
    }
}
