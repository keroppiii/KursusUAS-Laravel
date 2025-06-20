<?php

namespace App\Livewire;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Kursus;
use Livewire\Component;
use Livewire\WithPagination;

class PendaftaranIndex extends Component
{
    use WithPagination;

    public $peserta_id, $kursus_id, $status, $pendaftaran_id;
    public $isEdit = false;

    protected $rules = [
        'peserta_id' => 'required|exists:pesertas,id',
        'kursus_id' => 'required|exists:kursuses,id',
        'status' => 'required|string|max:100',
    ];

    public function render()
    {
        return view('livewire.pendaftaran-index', [
            'pendaftarans' => Pendaftaran::with(['peserta', 'kursus'])->latest()->paginate(5),
            'pesertas' => Peserta::all(),
            'kursusList' => Kursus::all(),
        ])->layout('layouts.app');
    }

    public function resetForm()
    {
        $this->reset(['peserta_id', 'kursus_id', 'status', 'pendaftaran_id', 'isEdit']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        // Cek apakah peserta sudah daftar ke kursus ini
        $sudahAda = Pendaftaran::where('peserta_id', $this->peserta_id)
            ->where('kursus_id', $this->kursus_id)
            ->exists();

        if ($sudahAda) {
            session()->flash('message', 'Peserta sudah terdaftar di kursus ini.');
            return;
        }

        Pendaftaran::create([
            'peserta_id' => $this->peserta_id,
            'kursus_id' => $this->kursus_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pendaftaran berhasil disimpan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->peserta_id = $pendaftaran->peserta_id;
        $this->kursus_id = $pendaftaran->kursus_id;
        $this->status = $pendaftaran->status;
        $this->pendaftaran_id = $pendaftaran->id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $pendaftaran = Pendaftaran::findOrFail($this->pendaftaran_id);
        $pendaftaran->update([
            'peserta_id' => $this->peserta_id,
            'kursus_id' => $this->kursus_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pendaftaran berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Pendaftaran::findOrFail($id)->delete();
        session()->flash('message', 'Pendaftaran berhasil dihapus.');
    }
}
