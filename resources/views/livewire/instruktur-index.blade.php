<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Manajemen Instruktur</h1>

    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form Tambah/Edit Instruktur -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Instruktur</label>
            <input type="text" wire:model="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" placeholder="Masukkan nama instruktur">
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" placeholder="Masukkan email">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $isEdit ? 'Update' : 'Simpan' }}
            </button>

            @if ($isEdit)
                <button type="button" wire:click="resetForm" class="text-gray-600 hover:underline">Batal</button>
            @endif
        </div>
    </form>

    <!-- Tabel Instruktur -->
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left font-medium text-gray-600">Nama</th>
                <th class="px-4 py-2 text-left font-medium text-gray-600">Email</th>
                <th class="px-4 py-2 text-left font-medium text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach ($instrukturs as $instruktur)
                <tr>
                    <td class="px-4 py-2">{{ $instruktur->nama }}</td>
                    <td class="px-4 py-2">{{ $instruktur->email }}</td>
                    <td class="px-4 py-2">
                        <button wire:click="edit({{ $instruktur->id }})" class="text-blue-600 hover:underline mr-2">Edit</button>
                        <button wire:click="delete({{ $instruktur->id }})" class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $instrukturs->links() }}
    </div>
</div>
