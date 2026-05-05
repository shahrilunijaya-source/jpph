<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class ChatbotFab extends Component
{
    public bool $open = false;

    /** @var array<int, array{who:string,text:string,refs?:array}> */
    public array $messages = [];

    public string $input = '';

    public bool $thinking = false;

    public function mount(): void
    {
        $locale = app()->getLocale();
        $this->messages = [
            [
                'who' => 'bot',
                'text' => $locale === 'en'
                    ? 'Hi! I\'m JPPH Assistant. Ask me about stamp duty, housing loan valuation, or any JPPH service.'
                    : 'Selamat datang! Saya Pembantu JPPH. Tanya saya tentang duti setem, pinjaman perumahan, atau perkhidmatan JPPH.',
            ],
        ];
    }

    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    public function send(): void
    {
        $msg = trim($this->input);
        if ($msg === '') return;

        $this->messages[] = ['who' => 'user', 'text' => $msg];
        $this->input = '';
        $this->thinking = true;
        $this->reply($msg);
    }

    public function setSuggestion(string $msg): void
    {
        $this->input = $msg;
        $this->send();
    }

    private function reply(string $msg): void
    {
        $locale = app()->getLocale();
        $hits = Faq::query()
            ->where(function ($q) use ($msg) {
                $q->where('question_bm', 'LIKE', '%' . $msg . '%')
                  ->orWhere('question_en', 'LIKE', '%' . $msg . '%')
                  ->orWhere('answer_bm', 'LIKE', '%' . $msg . '%')
                  ->orWhere('answer_en', 'LIKE', '%' . $msg . '%');
            })
            ->limit(3)
            ->get();

        if ($hits->isEmpty()) {
            // Try keyword fallback for common terms
            $keywords = ['duti', 'setem', 'pinjaman', 'perumahan', 'tukar syarat', 'sewaan', 'cawangan', 'hubungi', 'penilaian'];
            foreach ($keywords as $kw) {
                if (stripos($msg, $kw) !== false) {
                    $hits = Faq::query()
                        ->where('question_bm', 'LIKE', "%{$kw}%")
                        ->orWhere('question_en', 'LIKE', "%{$kw}%")
                        ->limit(2)
                        ->get();
                    if ($hits->isNotEmpty()) break;
                }
            }
        }

        if ($hits->isEmpty()) {
            $this->messages[] = [
                'who' => 'bot',
                'text' => $locale === 'en'
                    ? 'I\'m not sure I have an exact answer for that. You can browse our FAQ section, or contact your nearest JPPH branch via the Contact page.'
                    : 'Maaf, saya tidak pasti jawapan untuk itu. Anda boleh menyemak bahagian Soalan Lazim atau hubungi cawangan JPPH terdekat.',
                'refs' => [],
            ];
        } else {
            $top = $hits->first();
            $this->messages[] = [
                'who' => 'bot',
                'text' => $top->answer($locale),
                'refs' => $hits->skip(1)->map(fn ($f) => $f->question($locale))->values()->all(),
            ];
        }

        $this->thinking = false;
    }

    public function render()
    {
        return view('livewire.chatbot-fab');
    }
}
