<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen p-4">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">
                📚 Sistem Peminjaman Ruangan
            </h1>

            <p class="text-gray-500 mt-1 text-sm">
                Kelola peminjaman ruangan menggunakan RFID & Barcode
            </p>
        </div>

        <!-- STATS -->
        <div class="bg-white rounded-xl shadow px-4 py-3 w-fit">

            <p class="text-gray-500 text-xs">
                Total Ruangan
            </p>

            <h2 class="text-2xl font-bold text-indigo-600">
                {{ $rooms->count() }}
            </h2>

        </div>

    </div>

    <!-- MENU -->
    <div class="flex flex-wrap gap-2 mb-6">

        <a href="/dashboard"
           class="bg-gray-700 hover:bg-gray-800 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            📋 Semua
        </a>

        <a href="/dashboard?filter=kosong"
           class="bg-green-500 hover:bg-green-600 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            🔓 Kosong
        </a>

        <a href="/dashboard?filter=dipinjam"
           class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            🔒 Dipinjam
        </a>

        <a href="/riwayat"
           class="bg-black hover:bg-gray-900 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            📊 Riwayat
        </a>

        <a href="/rfid"
           class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            📡 RFID
        </a>

        <a href="/return-scan"
           class="bg-orange-500 hover:bg-orange-600 transition text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
            📷 Pengembalian
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 shadow text-sm">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 shadow text-sm">
            {{ session('error') }}
        </div>

    @endif

    <!-- CARD -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">

        @foreach($rooms as $room)

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition duration-300 p-3">

            <!-- HEADER CARD -->
            <div class="flex items-start justify-between mb-3">

                <div>

                    <h2 class="text-sm font-bold text-gray-800 leading-tight">
                        {{ $room->nama_ruangan }}
                    </h2>

                    <p class="text-[11px] text-gray-400">
                        ID #{{ $room->id }}
                    </p>

                </div>

                @if($room->status == 'kosong')

                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-[10px] font-bold">
                        Kosong
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-[10px] font-bold">
                        Dipinjam
                    </span>

                @endif

            </div>

            <!-- STATUS -->
            <div class="bg-gray-50 rounded-lg p-2 border mb-3">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-[10px] text-gray-500">
                            Status
                        </p>

                        <h3 class="text-xs font-bold
                            {{ $room->status == 'kosong'
                                ? 'text-green-600'
                                : 'text-red-600'
                            }}">
                            {{ ucfirst($room->status) }}
                        </h3>

                    </div>

                    <div class="text-xl">

                        @if($room->status == 'kosong')
                            🔓
                        @else
                            🔒
                        @endif

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            @if($room->status == 'kosong')

                <a href="/rfid"
                   class="block text-center bg-blue-500 hover:bg-blue-600 transition text-white px-3 py-2 rounded-lg text-xs font-bold">
                    Pinjam
                </a>

            @else

                <a href="/return-scan"
                   class="block text-center bg-red-500 hover:bg-red-600 transition text-white px-3 py-2 rounded-lg text-xs font-bold">
                    Kembalikan
                </a>

            @endif

        </div>

        @endforeach

    </div>

</div>

</body>
</html>