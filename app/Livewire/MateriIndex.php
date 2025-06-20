<?php

namespace App\Livewire;

use App\Models\Materi;
use App\Models\Kursus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MateriIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $kursus_id, $judul, $deskripsi, $file, $materi_id;
    public $isEdit = false;

    protected $rules = [
        'kursus_id' => 'required|exists:kursuses,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ];

    public function render()
    {
        return view('livewire.materi-index', [
            'materis' => Materi::with('kursus')->latest()->paginate(5),
            'kursuses' => Kursus::all(),
        ])->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        $filePath = $this->file->store('materi', 'public');

        Materi::create([
            'kursus_id' => $this->kursus_id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'file_path' => $filePath,
        ]);

        session()->flash('message', 'Materi berhasil ditambahkan.');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['kursus_id', 'judul', 'deskripsi', 'file', 'materi_id', 'isEdit']);
        $this->resetValidation();
    }

    public function delete($id)
    {
        $materi = Materi::findOrFail($id);
        \Storage::disk('public')->delete($materi->file_path);
        $materi->delete();
        session()->flash('message', 'Materi berhasil dihapus.');
    }
}

