<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Halo, {{ auth()->user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-7xl mx-auto space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500 text-sm mb-1">Total Peserta</h3>
                <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Peserta::count() }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500 text-sm mb-1">Total Kursus</h3>
                <p class="text-2xl font-bold text-green-600">{{ \App\Models\Kursus::count() }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500 text-sm mb-1">Total Instruktur</h3>
                <p class="text-2xl font-bold text-purple-600">{{ \App\Models\Instruktur::count() }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500 text-sm mb-1">Total Pendaftaran</h3>
                <p class="text-2xl font-bold text-red-600">{{ \App\Models\Pendaftaran::count() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Selamat datang 👋</h3>
            <p class="text-gray-700">Anda berhasil login ke sistem manajemen kursus. Gunakan menu di sidebar untuk mulai mengelola data.</p>
        </div>
    </div>
</x-app-layout>
