<?php

namespace Tests\Feature;

use App\Livewire\Public\PengiraanDutiSetem;
use App\Livewire\Public\StatusDutiSetem;
use App\Livewire\Public\StatusPinjamanPerumahan;
use App\Models\CaseDutiSetem;
use App\Models\CasePinjamanPerumahan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatusLookupTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CaseDutiSetem::query()->create([
            'no_rujukan' => 'JPPH/DS/2026/99999',
            'pemohon_nama' => 'Test User',
            'pemohon_ic' => '850315-08-1234',
            'jenis_pindahmilik' => 'jual_beli',
            'nilai_hartanah_rm' => 750000,
            'status' => 'diluluskan',
            'tarikh_terima' => now()->subDays(30),
            'tarikh_kemaskini' => now()->subDays(2),
            'pegawai_penilai' => 'Test Officer',
            'cawangan' => 'Kuala Lumpur',
        ]);

        CasePinjamanPerumahan::query()->create([
            'no_rujukan' => 'JPPH/PP/2026/88888',
            'pemohon_nama' => 'Test User',
            'bank' => 'Maybank',
            'alamat_hartanah' => 'KL',
            'nilai_pasaran_rm' => 500000,
            'status' => 'dihantar_bank',
            'tarikh_terima' => now()->subDays(20),
            'tarikh_siap' => now()->subDays(5),
            'pegawai_penilai' => 'Test Officer',
        ]);
    }

    public function test_looks_up_duti_setem_case_by_reference(): void
    {
        Livewire::test(StatusDutiSetem::class)
            ->set('reference', 'JPPH/DS/2026/99999')
            ->call('lookup')
            ->assertSet('result.status', 'diluluskan')
            ->assertSet('error', null);
    }

    public function test_returns_error_for_unknown_duti_setem_reference(): void
    {
        $r = Livewire::test(StatusDutiSetem::class)
            ->set('reference', 'JPPH/DS/2026/00001')
            ->call('lookup');
        $r->assertSet('result', null);
        $this->assertNotNull($r->get('error'));
    }

    public function test_rejects_malformed_reference(): void
    {
        $r = Livewire::test(StatusDutiSetem::class)
            ->set('reference', 'INVALID-REF')
            ->call('lookup');
        $r->assertSet('result', null);
        $this->assertStringContainsString('Format', $r->get('error'));
    }

    public function test_looks_up_pinjaman_perumahan_case(): void
    {
        Livewire::test(StatusPinjamanPerumahan::class)
            ->set('reference', 'JPPH/PP/2026/88888')
            ->call('lookup')
            ->assertSet('result.status', 'dihantar_bank');
    }

    public function test_masks_ic_correctly(): void
    {
        $case = CaseDutiSetem::where('no_rujukan', 'JPPH/DS/2026/99999')->first();
        $this->assertSame('850315-**-1234', $case->masked_ic);
    }

    public function test_calculates_progressive_stamp_duty_500k(): void
    {
        // 1%×100k + 2%×400k = 1000 + 8000 = 9000
        $r = Livewire::test(PengiraanDutiSetem::class)
            ->set('nilaiHartanah', '500000')
            ->set('jenis', 'jual_beli')
            ->set('isWargaAsing', false);
        $this->assertSame(9000.0, (float) $r->instance()->pengiraan['total']);
    }

    public function test_calculates_progressive_stamp_duty_750k(): void
    {
        // 1000 + 8000 + 3%×250k=7500 = 16500
        $r = Livewire::test(PengiraanDutiSetem::class)
            ->set('nilaiHartanah', '750000');
        $this->assertSame(16500.0, (float) $r->instance()->pengiraan['total']);
    }

    public function test_calculates_progressive_stamp_duty_1500k(): void
    {
        // 1000 + 8000 + 15000 + 4%×500k=20000 = 44000
        $r = Livewire::test(PengiraanDutiSetem::class)
            ->set('nilaiHartanah', '1500000');
        $this->assertSame(44000.0, (float) $r->instance()->pengiraan['total']);
    }

    public function test_applies_flat_4_percent_for_foreigners(): void
    {
        $r = Livewire::test(PengiraanDutiSetem::class)
            ->set('nilaiHartanah', '500000')
            ->set('isWargaAsing', true);
        $this->assertSame(20000.0, (float) $r->instance()->pengiraan['total']);
    }
}
