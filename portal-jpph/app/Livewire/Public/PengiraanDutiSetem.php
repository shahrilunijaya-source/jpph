<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Computed;
use Livewire\Component;

class PengiraanDutiSetem extends Component
{
    public string $nilaiHartanah = '500000';

    public string $jenis = 'jual_beli';

    public bool $isWargaAsing = false;

    public function setExample(int $value): void
    {
        $this->nilaiHartanah = (string) $value;
    }

    #[Computed]
    public function pengiraan(): array
    {
        $value = (float) preg_replace('/[^\d.]/', '', $this->nilaiHartanah);
        if ($value <= 0) {
            return ['rows' => [], 'total' => 0, 'effective_rate' => 0, 'value' => 0];
        }

        // Foreigners: flat 4% (Stamp Act 1949 amendment 2024)
        if ($this->isWargaAsing) {
            $tax = $value * 0.04;
            return [
                'rows' => [
                    ['range' => 'Warganegara asing — kadar rata 4%', 'taxable' => $value, 'rate' => 0.04, 'tax' => $tax],
                ],
                'total' => $tax,
                'effective_rate' => 4.0,
                'value' => $value,
            ];
        }

        // Progressive slabs (Stamp Act 1949 First Schedule, Item 32)
        $brackets = [
            ['min' => 0,         'max' => 100_000,     'rate' => 0.01],
            ['min' => 100_000,   'max' => 500_000,     'rate' => 0.02],
            ['min' => 500_000,   'max' => 1_000_000,   'rate' => 0.03],
            ['min' => 1_000_000, 'max' => PHP_INT_MAX, 'rate' => 0.04],
        ];

        $rows = [];
        $total = 0;
        foreach ($brackets as $b) {
            if ($value <= $b['min']) break;
            $taxable = min($value, $b['max']) - $b['min'];
            if ($taxable <= 0) continue;
            $tax = $taxable * $b['rate'];
            $total += $tax;
            $rows[] = [
                'range' => sprintf(
                    'RM %s – RM %s',
                    number_format($b['min']),
                    $b['max'] === PHP_INT_MAX ? '∞' : number_format($b['max']),
                ),
                'taxable' => $taxable,
                'rate' => $b['rate'],
                'tax' => $tax,
            ];
        }

        // Pewarisan often exempt or reduced — flag in UI
        if ($this->jenis === 'pewarisan') {
            $rows[] = ['range' => __('Pewarisan: setem RM10 sahaja (Akta Setem 1949)'), 'taxable' => 0, 'rate' => 0, 'tax' => 10];
            $total = 10;
        }

        return [
            'rows' => $rows,
            'total' => $total,
            'effective_rate' => $value > 0 ? round(($total / $value) * 100, 4) : 0,
            'value' => $value,
        ];
    }

    public function render()
    {
        return view('livewire.public.pengiraan-duti-setem');
    }
}
