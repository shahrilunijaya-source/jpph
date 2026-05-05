<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<\Database\Factories\FaqFactory> */
    use HasFactory;

    protected $fillable = ['question_bm', 'question_en', 'answer_bm', 'answer_en', 'category', 'sort_order'];

    public function question(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->question_en : $this->question_bm;
    }

    public function answer(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'en' ? $this->answer_en : $this->answer_bm;
    }
}
