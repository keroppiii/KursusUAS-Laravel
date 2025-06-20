<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kursus;

class MateriByKursus extends Component
{
    public $kursusId;
    public $kursus;

    public function mount($kursusId)
    {
        $this->kursusId = $kursusId;
        $this->kursus = Kursus::with('materis')->findOrFail($kursusId);
    }

    public function render()
    {
        return view('livewire.materi-by-kursus')
            ->layout('layouts.app'); // pastikan path ini sesuai dengan lokasi file layout kamu
    }
}

