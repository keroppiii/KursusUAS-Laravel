<?php

namespace App\Livewire;

use App\Models\Kursus;
use App\Models\Instruktur;
use Livewire\Component;
use Livewire\WithPagination;

class KursusIndex extends Component
{
    use WithPagination;

    public $nama_kursus, $durasi, $biaya, $instruktur_id, $kursus_id;
    public $isEdit = false;

    protected $rules = [
        'nama_kursus' => 'required|string|max:255',
        'durasi' => 'required|string|max:100',
        'biaya' => 'required|integer|min:0',
        'instruktur_id' => 'required|exists:instrukturs,id',
    ];

    public function render()
    {
        return view('livewire.kursus-index', [
            'kursusList' => Kursus::with(['instruktur', 'pendaftarans'])->latest()->paginate(5),
            'instrukturs' => Instruktur::all()
        ])->layout('layouts.app');
    }

    public function resetForm()
    {
        $this->reset(['nama_kursus', 'durasi', 'biaya', 'instruktur_id', 'kursus_id', 'isEdit']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        Kursus::create([
            'nama_kursus' => $this->nama_kursus,
            'durasi' => $this->durasi,
            'biaya' => $this->biaya,
            'instruktur_id' => $this->instruktur_id,
        ]);

        session()->flash('message', 'Kursus berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $kursus = Kursus::findOrFail($id);
        $this->nama_kursus = $kursus->nama_kursus;
        $this->durasi = $kursus->durasi;
        $this->biaya = $kursus->biaya;
        $this->instruktur_id = $kursus->instruktur_id;
        $this->kursus_id = $kursus->id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama_kursus' => 'required|string|max:255',
            'durasi' => 'required|string|max:100',
            'biaya' => 'required|integer|min:0',
            'instruktur_id' => 'required|exists:instrukturs,id',
        ]);

        $kursus = Kursus::findOrFail($this->kursus_id);
        $kursus->update([
            'nama_kursus' => $this->nama_kursus,
            'durasi' => $this->durasi,
            'biaya' => $this->biaya,
            'instruktur_id' => $this->instruktur_id,
        ]);

        session()->flash('message', 'Kursus berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Kursus::findOrFail($id)->delete();
        session()->flash('message', 'Kursus berhasil dihapus.');
    }
}
