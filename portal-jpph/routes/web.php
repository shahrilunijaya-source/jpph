<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Public\DashboardStatistik;
use App\Livewire\Public\DirektoriHub;
use App\Livewire\Public\Homepage;
use App\Livewire\Public\PengiraanDutiSetem;
use App\Livewire\Public\ProfilHub;
use App\Livewire\Public\StatusDutiSetem;
use App\Livewire\Public\StatusPinjamanPerumahan;
use App\Livewire\Public\StatusTukarSyarat;
use Illuminate\Support\Facades\Route;

// Public site (Livewire 4: use Route::livewire)
Route::livewire('/', Homepage::class)->name('home');
Route::livewire('/profil', ProfilHub::class)->name('profil');
Route::livewire('/direktori', DirektoriHub::class)->name('direktori');
Route::livewire('/dashboard-statistik', DashboardStatistik::class)->name('dashboard.statistik');
Route::livewire('/microsite/status-duti-setem', StatusDutiSetem::class)->name('microsite.duti-setem');
Route::livewire('/microsite/status-pinjaman-perumahan', StatusPinjamanPerumahan::class)->name('microsite.pinjaman');
Route::livewire('/microsite/status-tukar-syarat', StatusTukarSyarat::class)->name('microsite.tukar-syarat');
Route::livewire('/microsite/pengiraan-duti-setem', PengiraanDutiSetem::class)->name('microsite.calc-duti');

// Static pages from CMS
Route::get('/laman/{slug}', \App\Http\Controllers\StaticPageController::class)->name('page.show');

// Post-login dispatcher (Breeze sends here)
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (! $user) {
        return redirect()->route('login');
    }
    return redirect()->route('myjpph.dashboard');
})->middleware(['auth'])->name('dashboard');

// MyJPPH staff portal
Route::middleware('auth')->group(function () {
    Route::view('/myjpph', 'myjpph.dashboard')->name('myjpph.dashboard');
});

// Locale switcher (BM/EN)
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['ms', 'en'], true)) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
