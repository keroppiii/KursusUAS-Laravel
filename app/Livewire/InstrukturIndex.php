<?php

namespace App\Livewire;

use App\Models\Instruktur;
use Livewire\Component;
use Livewire\WithPagination;

class InstrukturIndex extends Component
{
    use WithPagination;

    public $nama, $email, $instruktur_id;
    public $isEdit = false;


    protected $rules = [
    'nama' => 'required|string|max:255',
    'email' => 'required|email|unique:instrukturs,email',
    ];


    public function render()
    {
    return view('livewire.instruktur-index', [
        'instrukturs' => Instruktur::latest()->paginate(5),
    ])->layout('layouts.app');
    }


    public function resetForm()
    {
        $this->reset(['nama', 'email','instruktur_id', 'isEdit']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        Instruktur::create([
            'nama' => $this->nama,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Instruktur berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Instruktur::findOrFail($id);
        $this->nama = $data->nama;
        $this->email = $data->email;
        $this->instruktur_id = $data->id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:instrukturs,email,' . $this->instruktur_id,
        ]);

        $data = Instruktur::findOrFail($this->instruktur_id);
        $data->update([
            'nama' => $this->nama,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Instruktur berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Instruktur::findOrFail($id)->delete();
        session()->flash('message', 'Instruktur berhasil dihapus.');
    }

}
