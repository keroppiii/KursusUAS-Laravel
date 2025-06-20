<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
        📚 Materi untuk Kursus: <span class="text-blue-600">{{ $kursus->nama_kursus }}</span>
    </h2>

    @if ($kursus->materis->isEmpty())
        <div class="text-gray-500 italic">Belum ada materi yang ditambahkan untuk kursus ini.</div>
    @else
        <div class="space-y-6">
            @foreach ($kursus->materis as $materi)
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50 hover:shadow transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $materi->judul }}</h3>
                    <p class="text-sm text-gray-700 mb-3">{{ $materi->deskripsi ?: 'Tidak ada deskripsi.' }}</p>

                    @if ($materi->file_path)
                        <a href="{{ asset('storage/' . $materi->file_path) }}"
                           target="_blank"
                           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition text-sm">
                            📄 Lihat File Materi
                        </a>
                    @else
                        <span class="text-red-500 text-sm">Tidak ada file materi.</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('dashboard') }}" class="inline-block text-blue-600 hover:underline text-sm">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>
