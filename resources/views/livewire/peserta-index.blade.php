<div class="max-w-4xl mx-auto py-6">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 border border-green-200 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Tambah / Edit Peserta --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">
            {{ $isEdit ? 'Edit Peserta' : 'Tambah Peserta' }}
        </h2>

        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" wire:model.defer="nama" class="w-full p-2 border rounded" placeholder="Nama Lengkap">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" wire:model.defer="email" class="w-full p-2 border rounded" placeholder="Email">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    {{ $isEdit ? 'Update' : 'Tambah' }}
                </button>
                @if ($isEdit)
                    <button type="button" wire:click="resetForm" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow">
                        Batal
                    </button>
                @endif
            </div>
        </form>
    </div>

    {{-- Tabel Data Peserta --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Peserta</h2>

        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesertas as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $p->nama }}</td>
                        <td class="border px-4 py-2">{{ $p->email }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <button wire:click="edit({{ $p->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $p->id }})" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada peserta terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pesertas->links() }}
        </div>
    </div>
</div>
