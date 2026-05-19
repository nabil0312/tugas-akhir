<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Peminjaman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-dark-950 min-h-screen flex items-center justify-center p-4">

<div class="card p-8 sm:p-10 rounded-2xl w-full max-w-md fade-in" id="rfid-form-container">

    <a href="/dashboard" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-400 transition text-sm font-medium mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>

    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-lg bg-indigo-500/10 flex items-center justify-center">
            <i data-lucide="scan-line" class="w-5 h-5 text-indigo-400"></i>
        </div>
        <h1 class="text-2xl font-bold text-white">Scan RFID</h1>
    </div>
    <p class="text-slate-500 mb-8 text-sm">Tempel kartu RFID untuk meminjam ruangan</p>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl mb-4 p-5" id="alert-success">
            <div class="flex items-center gap-2 text-emerald-400 font-medium text-sm mb-4">
                <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                {{ session('success') }}
            </div>
            <div class="flex gap-2">
                @if(session('borrowing_id'))
                    <a href="/receipt/{{ session('borrowing_id') }}"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 transition text-white px-4 py-2.5 rounded-lg text-sm font-medium">
                        <i data-lucide="printer" class="w-4 h-4"></i> Cetak Struk
                    </a>
                @endif
                <a href="/dashboard"
                   class="inline-flex items-center gap-2 bg-dark-700 hover:bg-dark-600 border border-glass-border transition text-white px-4 py-2.5 rounded-lg text-sm font-medium">
                    <i data-lucide="layout-grid" class="w-4 h-4"></i> Dashboard
                </a>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-3.5 rounded-xl mb-4 text-sm font-medium flex items-center gap-2" id="alert-error">
            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
            {{ session('error') }}
        </div>
    @endif

    <form action="/rfid" method="POST" id="rfid-form">
        @csrf

        <div class="mb-4">
            <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="nama">
                <i data-lucide="user" class="w-4 h-4"></i> Nama Peminjam
            </label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan nama..."
                class="w-full bg-dark-800 border border-glass-border text-white placeholder-slate-600 p-3.5 rounded-xl text-base focus:border-blue-500 focus:outline-none transition" required>
        </div>

        <div class="mb-4">
            <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="rfid_uid">
                <i data-lucide="credit-card" class="w-4 h-4"></i> Kartu RFID
            </label>
            <input type="text" name="rfid_uid" id="rfid_uid" placeholder="Scan RFID..." autofocus
                class="w-full bg-dark-800 border border-glass-border text-white placeholder-slate-600 p-3.5 rounded-xl text-base focus:border-indigo-500 focus:outline-none transition" required>
        </div>

        <div class="mb-4">
            <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="room_id">
                <i data-lucide="door-open" class="w-4 h-4"></i> Pilih Ruangan
            </label>
            <select name="room_id" id="room_id"
                class="w-full bg-dark-800 border border-glass-border text-white p-3.5 rounded-xl text-base focus:border-blue-500 focus:outline-none transition appearance-none cursor-pointer">
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" class="bg-dark-800">{{ $room->nama_ruangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="start_time">
                    <i data-lucide="clock" class="w-4 h-4"></i> Mulai Jam
                </label>
                <input type="time" name="start_time" id="start_time"
                    class="w-full bg-dark-800 border border-glass-border text-white p-3.5 rounded-xl text-base focus:border-blue-500 focus:outline-none transition" required>
            </div>
            <div>
                <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="end_time">
                    <i data-lucide="clock" class="w-4 h-4"></i> Selesai Jam
                </label>
                <input type="time" name="end_time" id="end_time"
                    class="w-full bg-dark-800 border border-glass-border text-white p-3.5 rounded-xl text-base focus:border-blue-500 focus:outline-none transition" required>
            </div>
        </div>

        <button type="submit" id="btn-submit"
            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white p-3.5 rounded-xl font-semibold text-base transition">
            <i data-lucide="key-round" class="w-4 h-4"></i> Pinjam Ruangan
        </button>
    </form>

</div>

<script>lucide.createIcons();</script>
</body>
</html>