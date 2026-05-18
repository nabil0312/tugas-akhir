<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- HEADER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Sistem Peminjaman Ruangan
                </h1>

                <p class="text-gray-500 mt-2 text-sm">
                    Kelola peminjaman ruangan dengan sistem RFID dan QR Code
                </p>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-3 gap-3">

                <div class="bg-gray-50 border rounded-xl px-5 py-4 text-center min-w-[120px]">
                    <p class="text-xs text-gray-500 mb-1">
                        Total
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $rooms->count() }}
                    </h2>
                </div>

                <div class="bg-green-50 border border-green-100 rounded-xl px-5 py-4 text-center min-w-[120px]">
                    <p class="text-xs text-green-600 mb-1">
                        Kosong
                    </p>

                    <h2 class="text-2xl font-bold text-green-700">
                        {{ $rooms->where('status','kosong')->count() }}
                    </h2>
                </div>

                <div class="bg-red-50 border border-red-100 rounded-xl px-5 py-4 text-center min-w-[120px]">
                    <p class="text-xs text-red-600 mb-1">
                        Dipinjam
                    </p>

                    <h2 class="text-2xl font-bold text-red-700">
                        {{ $rooms->where('status','dipinjam')->count() }}
                    </h2>
                </div>

            </div>

        </div>

    </div>

    <!-- MENU -->
    <div class="flex flex-wrap gap-3 mb-6">

        <a href="/dashboard"
           class="bg-gray-800 hover:bg-black transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Semua
        </a>

        <a href="/dashboard?filter=kosong"
           class="bg-green-600 hover:bg-green-700 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Ruangan Kosong
        </a>

        <a href="/dashboard?filter=dipinjam"
           class="bg-red-600 hover:bg-red-700 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Sedang Dipinjam
        </a>

        <a href="/riwayat"
           class="bg-slate-700 hover:bg-slate-800 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Riwayat
        </a>

        <a href="/rfid"
           class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Peminjaman
        </a>

        <a href="/return-scan"
           class="bg-orange-500 hover:bg-orange-600 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            Pengembalian
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm">
            {{ session('error') }}
        </div>

    @endif

    <!-- ROOM GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">

        @foreach($rooms as $room)

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300">

            <!-- TOP -->
            <div class="flex items-start justify-between mb-5">

                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        {{ $room->nama_ruangan }}
                    </h2>

                    <p class="text-xs text-gray-400 mt-1">
                        ID Ruangan #{{ $room->id }}
                    </p>
                </div>

                @if($room->status == 'kosong')

                    <span class="bg-green-100 text-green-700 text-[11px] font-semibold px-3 py-1 rounded-full">
                        Kosong
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 text-[11px] font-semibold px-3 py-1 rounded-full">
                        Dipinjam
                    </span>

                @endif

            </div>

            <!-- STATUS -->
            <div class="border rounded-xl p-4 mb-5 bg-gray-50">

                <p class="text-xs text-gray-500 mb-2">
                    Status Ruangan
                </p>

                @if($room->status == 'kosong')

                    <h3 class="text-green-600 font-bold text-lg">
                        Tersedia
                    </h3>

                @else

                    <h3 class="text-red-600 font-bold text-lg">
                        Tidak Tersedia
                    </h3>

                @endif

            </div>

            <!-- BUTTON -->
            @if($room->status == 'kosong')

                <a href="/rfid"
                   class="block text-center bg-indigo-600 hover:bg-indigo-700 transition text-white py-3 rounded-xl text-sm font-semibold">
                    Pinjam Ruangan
                </a>

            @else

                <a href="/return-scan"
                   class="block text-center bg-red-500 hover:bg-red-600 transition text-white py-3 rounded-xl text-sm font-semibold">
                    Kembalikan
                </a>

            @endif

        </div>

        @endforeach

    </div>

</div>

</body>
</html>