<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $fillable = ['slug', 'title_bm', 'title_en', 'body_bm', 'body_en', 'published', 'updated_by'];

    protected function casts(): array
    {
        return ['published' => 'boolean'];
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function title(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->title_en : $this->title_bm;
    }

    public function body(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->body_en : $this->body_bm;
    }
}
