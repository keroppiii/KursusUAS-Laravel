<div class="max-w-4xl mx-auto py-6">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 border border-green-200 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Tambah/Edit Pendaftaran --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">
            {{ $isEdit ? 'Edit Pendaftaran' : 'Tambah Pendaftaran' }}
        </h2>

        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="space-y-4">

            <div>
                <label class="block text-sm font-medium">Peserta</label>
                <select wire:model.defer="peserta_id" class="w-full p-2 border rounded">
                    <option value="">-- Pilih Peserta --</option>
                    @foreach ($pesertas as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
                @error('peserta_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Kursus</label>
                <select wire:model.defer="kursus_id" class="w-full p-2 border rounded">
                    <option value="">-- Pilih Kursus --</option>
                    @foreach ($kursusList as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kursus }}</option>
                    @endforeach
                </select>
                @error('kursus_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Status</label>
                <input type="text" wire:model.defer="status" class="w-full p-2 border rounded" placeholder="Status (aktif/sedang berjalan)">
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    {{ $isEdit ? 'Update' : 'Tambah' }}
                </button>
                @if ($isEdit)
                    <button type="button" wire:click="resetForm" class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400">
                        Batal
                    </button>
                @endif
            </div>

        </form>
    </div>

    {{-- Tabel Data Pendaftaran --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Pendaftaran</h2>

        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Peserta</th>
                    <th class="border px-4 py-2 text-left">Kursus</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendaftarans as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $p->peserta->nama }}</td>
                        <td class="border px-4 py-2">{{ $p->kursus->nama_kursus }}</td>
                        <td class="border px-4 py-2">{{ $p->status }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <button wire:click="edit({{ $p->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $p->id }})" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data pendaftaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pendaftarans->links() }}
        </div>
    </div>
</div>
