<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- HEADER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Riwayat Peminjaman
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Data seluruh aktivitas peminjaman dan pengembalian ruangan
                </p>
            </div>

            <a href="/dashboard"
               class="bg-gray-800 hover:bg-black transition text-white px-5 py-3 rounded-xl text-sm font-medium w-fit">
                Kembali ke Dashboard
            </a>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">
                            Nama
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">
                            Ruangan
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">
                            Waktu Pinjam
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">
                            Waktu Kembali
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($history as $item)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- NAMA -->
                        <td class="px-6 py-4">

                            <div>
                                <h2 class="font-semibold text-gray-800">
                                    {{ $item->borrower_name }}
                                </h2>

                                <p class="text-xs text-gray-400 mt-1">
                                    ID #{{ $item->id }}
                                </p>
                            </div>

                        </td>

                        <!-- ROOM -->
                        <td class="px-6 py-4 text-gray-700 font-medium">
                            {{ $item->room->nama_ruangan ?? '-' }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4">

                            @if($item->status == 'dipinjam')

                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    Dipinjam
                                </span>

                            @else

                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    Dikembalikan
                                </span>

                            @endif

                        </td>

                        <!-- PINJAM -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $item->borrowed_at }}
                        </td>

                        <!-- KEMBALI -->
                        <td class="px-6 py-4 text-sm text-gray-600">

                            @if($item->returned_at)

                                {{ $item->returned_at }}

                            @else

                                <span class="text-gray-400">
                                    Belum dikembalikan
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-10 text-gray-400">

                            Belum ada data peminjaman

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>