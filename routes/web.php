<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\InstrukturIndex;
use App\Livewire\MateriByKursus;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/instruktur', InstrukturIndex::class)->name('instruktur.index');
});

Route::get('/kursus', \App\Livewire\KursusIndex::class)->name('kursus.index');

Route::get('/pendaftaran', \App\Livewire\PendaftaranIndex::class)->name('pendaftaran.index');

Route::get('/peserta', \App\Livewire\PesertaIndex::class)->name('peserta.index');

Route::get('/materi', \App\Livewire\MateriIndex::class)->middleware('auth')->name('materi');

Route::get('/kursus/{kursusId}/materi', MateriByKursus::class)->name('materi.kursus');

require __DIR__.'/auth.php';

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
