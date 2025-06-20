<?php

namespace App\Livewire;

use App\Models\Peserta;
use Livewire\Component;
use Livewire\WithPagination;

class PesertaIndex extends Component
{
    use WithPagination;

    public $nama, $email, $peserta_id;
    public $isEdit = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:pesertas,email',
    ];

    public function render()
    {
        return view('livewire.peserta-index', [
            'pesertas' => Peserta::latest()->paginate(5)
        ])->layout('layouts.app');
    }

    public function resetForm()
    {
        $this->reset(['nama', 'email', 'peserta_id', 'isEdit']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        Peserta::create([
            'nama' => $this->nama,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Peserta berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $this->peserta_id = $peserta->id;
        $this->nama = $peserta->nama;
        $this->email = $peserta->email;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pesertas,email,' . $this->peserta_id,
        ]);

        $peserta = Peserta::findOrFail($this->peserta_id);
        $peserta->update([
            'nama' => $this->nama,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Peserta berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Peserta::findOrFail($id)->delete();
        session()->flash('message', 'Peserta berhasil dihapus.');
    }
}
