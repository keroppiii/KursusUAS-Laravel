<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Kursus</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama Kursus</label>
            <input type="text" wire:model.defer="nama_kursus" class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" />
            @error('nama_kursus') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Durasi</label>
            <input type="text" wire:model.defer="durasi" class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" />
            @error('durasi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Biaya</label>
            <input type="number" wire:model.defer="biaya" class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" />
            @error('biaya') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Instruktur</label>
            <select wire:model.defer="instruktur_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Instruktur --</option>
                @foreach ($instrukturs as $i)
                    <option value="{{ $i->id }}">{{ $i->nama }}</option>
                @endforeach
            </select>
            @error('instruktur_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-2 flex gap-2 mt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Tambah' }}
            </button>
            @if ($isEdit)
                <button type="button" wire:click="resetForm" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded">
                    Batal
                </button>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Kursus</th>
                    <th class="p-3 border">Instruktur</th>
                    <th class="p-3 border">Durasi</th>
                    <th class="p-3 border">Biaya</th>
                    <th class="p-3 border">Jumlah Peserta</th>
                    <th class="p-3 border">Aksi</th>
                    <th class="p-3 border">Materi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kursusList as $i => $k)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $i + 1 }}</td>
                        <td class="p-2 border">{{ $k->nama_kursus }}</td>
                        <td class="p-2 border">{{ $k->instruktur->nama }}</td>
                        <td class="p-2 border">{{ $k->durasi }}</td>
                        <td class="p-2 border">Rp{{ number_format($k->biaya, 0, ',', '.') }}</td>
                        <td class="p-2 border">{{ $k->pendaftarans->count() }} peserta</td>
                        <td class="p-2 border space-x-2">
                            <button wire:click="edit({{ $k->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $k->id }})" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                        <td class="p-2 border">
                            <a href="{{ route('materi.kursus', $k->id) }}" class="text-blue-500 hover:underline">Lihat Materi</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">Belum ada kursus.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kursusList->links() }}
    </div>
</div>
