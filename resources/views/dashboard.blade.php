<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Peminjaman Ruangan</title>
    <meta name="description" content="Dashboard sistem peminjaman ruangan dengan RFID dan QR Code">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-dark-950 min-h-screen text-white">

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    <!-- HEADER -->
    <div class="card rounded-2xl p-6 sm:p-8 mb-6 fade-in">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                    <i data-lucide="building-2" class="w-6 h-6 text-blue-400"></i>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">
                        Peminjaman Ruangan
                    </h1>
                    <p class="text-slate-500 mt-1 text-sm sm:text-base">
                        Kelola ruangan dengan RFID & QR Code
                    </p>
                </div>
            </div>

            <!-- STATS -->
            <div class="flex gap-3">
                <div class="bg-dark-800 border border-glass-border rounded-xl px-5 py-3 text-center min-w-[100px]">
                    <p class="text-xs text-slate-500 mb-1">Total</p>
                    <h2 class="text-2xl font-bold text-white">{{ $rooms->count() }}</h2>
                </div>
                <div class="bg-emerald-500/5 border border-emerald-500/15 rounded-xl px-5 py-3 text-center min-w-[100px]">
                    <p class="text-xs text-emerald-500 mb-1">Kosong</p>
                    <h2 class="text-2xl font-bold text-emerald-400">{{ $rooms->where('status','kosong')->count() }}</h2>
                </div>
                <div class="bg-rose-500/5 border border-rose-500/15 rounded-xl px-5 py-3 text-center min-w-[100px]">
                    <p class="text-xs text-rose-500 mb-1">Dipinjam</p>
                    <h2 class="text-2xl font-bold text-rose-400">{{ $rooms->where('status','dipinjam')->count() }}</h2>
                </div>
            </div>

        </div>
    </div>

    <!-- MENU -->
    <div class="flex flex-wrap gap-2 mb-6 fade-in" style="animation-delay: 0.05s;">

        <a href="/dashboard" id="btn-semua"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            <i data-lucide="layout-grid" class="w-4 h-4"></i> Semua
        </a>

        <a href="/dashboard?filter=kosong" id="btn-kosong"
           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            <i data-lucide="circle-check" class="w-4 h-4"></i> Kosong
        </a>

        <a href="/dashboard?filter=dipinjam" id="btn-dipinjam"
           class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-500 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            <i data-lucide="circle-x" class="w-4 h-4"></i> Dipinjam
        </a>

        <a href="/riwayat" id="btn-riwayat"
           class="inline-flex items-center gap-2 bg-dark-700 hover:bg-dark-600 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium border border-glass-border">
            <i data-lucide="history" class="w-4 h-4"></i> Riwayat
        </a>

        <a href="/rfid" id="btn-peminjaman"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            <i data-lucide="scan-line" class="w-4 h-4"></i> Peminjaman
        </a>

        <a href="/return-scan" id="btn-pengembalian"
           class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-500 transition text-white px-5 py-2.5 rounded-xl text-sm font-medium">
            <i data-lucide="undo-2" class="w-4 h-4"></i> Pengembalian
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-3.5 rounded-xl mb-5 text-sm font-medium fade-in flex items-center gap-3" id="alert-success">
            <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 px-5 py-3.5 rounded-xl mb-5 text-sm font-medium fade-in flex items-center gap-3" id="alert-error">
            <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- ROOM GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">

        @foreach($rooms as $room)

        <div class="card rounded-2xl p-5 flex flex-col" id="room-card-{{ $room->id }}">

            <!-- TOP -->
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-white">
                        {{ $room->nama_ruangan }}
                    </h2>
                    <p class="text-xs text-slate-600 mt-1">
                        ID #{{ $room->id }}
                    </p>
                </div>

                @if($room->status == 'kosong')
                    <span class="inline-flex items-center gap-1.5 text-emerald-400 text-xs font-medium bg-emerald-500/10 px-3 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full dot-pulse"></span>
                        Kosong
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 text-rose-400 text-xs font-medium bg-rose-500/10 px-3 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 bg-rose-400 rounded-full dot-pulse"></span>
                        Dipinjam
                    </span>
                @endif
            </div>

            <!-- STATUS -->
            <div class="border border-glass-border rounded-xl p-4 mb-4 bg-dark-900/50">
                <p class="text-xs text-slate-600 mb-1.5">Status</p>

                @if($room->status == 'kosong')
                    <div class="flex items-center gap-2">
                        <i data-lucide="door-open" class="w-5 h-5 text-emerald-400"></i>
                        <h3 class="text-emerald-400 font-semibold text-base">Tersedia</h3>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <i data-lucide="door-closed" class="w-5 h-5 text-rose-400"></i>
                        <h3 class="text-rose-400 font-semibold text-base">Tidak Tersedia</h3>
                    </div>
                @endif
            </div>

            <!-- BUTTON -->
            <div class="mt-auto">
                @if($room->status == 'kosong')
                    <a href="/rfid"
                       class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 transition text-white py-3 rounded-xl text-sm font-semibold w-full">
                        <i data-lucide="key-round" class="w-4 h-4"></i>
                        Pinjam
                    </a>
                @else
                    <a href="/return-scan"
                       class="flex items-center justify-center gap-2 bg-dark-700 hover:bg-dark-600 border border-glass-border transition text-white py-3 rounded-xl text-sm font-semibold w-full">
                        <i data-lucide="undo-2" class="w-4 h-4"></i>
                        Kembalikan
                    </a>
                @endif
            </div>

        </div>

        @endforeach

    </div>

</div>

<script>lucide.createIcons();</script>
</body>
</html>