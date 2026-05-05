<?php

namespace App\Livewire\Public;

use App\Models\Page;
use Livewire\Component;

class ProfilHub extends Component
{
    public function render()
    {
        $slugs = [
            'perutusan-ketua-pengarah',
            'latar-belakang',
            'visi-misi-objektif',
            'peranan-jpph',
            'nilai-prinsip-panduan',
            'perkhidmatan-teras',
            'piagam-pelanggan',
            'carta-organisasi',
            'ketua-pegawai-digital-cdo',
            'logo-jpph',
        ];
        $pages = Page::whereIn('slug', $slugs)->where('published', true)->get()->keyBy('slug');
        $ordered = collect($slugs)->map(fn ($s) => $pages->get($s))->filter()->values();

        $iconMap = [
            'perutusan-ketua-pengarah' => 'paper-airplane',
            'latar-belakang' => 'building-office',
            'visi-misi-objektif' => 'sparkles',
            'peranan-jpph' => 'users',
            'nilai-prinsip-panduan' => 'check-circle',
            'perkhidmatan-teras' => 'document-text',
            'piagam-pelanggan' => 'banknotes',
            'carta-organisasi' => 'users',
            'ketua-pegawai-digital-cdo' => 'sparkles',
            'logo-jpph' => 'eye',
        ];

        return view('livewire.public.profil-hub', ['pages' => $ordered, 'iconMap' => $iconMap]);
    }
}
