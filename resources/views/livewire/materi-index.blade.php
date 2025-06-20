<div class="max-w-4xl mx-auto py-6">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 border border-green-200 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Tambah Materi --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">Tambah Materi</h2>

        <form wire:submit.prevent="save" class="space-y-4" enctype="multipart/form-data">

            <div>
                <label class="block text-sm font-medium">Kursus</label>
                <select wire:model="kursus_id" class="w-full p-2 border rounded">
                    <option value="">-- Pilih Kursus --</option>
                    @foreach($kursuses as $kursus)
                        <option value="{{ $kursus->id }}">{{ $kursus->nama_kursus }}</option>
                    @endforeach
                </select>
                @error('kursus_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Judul Materi</label>
                <input type="text" wire:model="judul" class="w-full p-2 border rounded" />
                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Deskripsi</label>
                <textarea wire:model="deskripsi" class="w-full p-2 border rounded" rows="3"></textarea>
                @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Upload File (PDF/DOC)</label>
                <input type="file" wire:model="file" class="w-full p-2 border rounded" />
                @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    Simpan Materi
                </button>
            </div>

        </form>
    </div>

    {{-- List Materi --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Materi</h2>

        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Kursus</th>
                    <th class="border px-4 py-2 text-left">Deskripsi</th>
                    <th class="border px-4 py-2 text-left">File</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materis as $materi)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $materi->judul }}</td>
                        <td class="border px-4 py-2">{{ $materi->kursus->nama_kursus }}</td>
                        <td class="border px-4 py-2">{{ $materi->deskripsi }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="text-blue-600 underline">
                                📄 Lihat
                            </a>
                        </td>
                        <td class="border px-4 py-2">
                            <button wire:click="delete({{ $materi->id }})" class="text-red-600 hover:underline"
                                onclick="return confirm('Yakin ingin menghapus materi ini?')">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada materi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $materis->links() }}
        </div>
    </div>

</div>
