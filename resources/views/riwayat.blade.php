<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
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
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center">
                    <i data-lucide="history" class="w-5 h-5 text-purple-400"></i>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Riwayat Peminjaman</h1>
                    <p class="text-sm text-slate-500 mt-1">Data aktivitas peminjaman dan pengembalian</p>
                </div>
            </div>

            <a href="/dashboard"
               class="inline-flex items-center gap-2 bg-dark-700 hover:bg-dark-600 border border-glass-border transition text-white px-5 py-2.5 rounded-xl text-sm font-medium w-fit">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Dashboard
            </a>
        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-3.5 rounded-xl mb-5 text-sm font-medium fade-in flex items-center gap-2">
            <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="card rounded-2xl overflow-hidden fade-in" style="animation-delay: 0.05s;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-dark-800/60 border-b border-glass-border">
                    <tr>
                        <th class="text-left px-5 py-4 text-sm font-semibold text-slate-400">Nama</th>
                        <th class="text-left px-5 py-4 text-sm font-semibold text-slate-400">Ruangan</th>
                        <th class="text-left px-5 py-4 text-sm font-semibold text-slate-400">Status</th>
                        <th class="text-left px-5 py-4 text-sm font-semibold text-slate-400">Waktu Pinjam</th>
                        <th class="text-left px-5 py-4 text-sm font-semibold text-slate-400">Waktu Kembali</th>
                        <th class="text-center px-5 py-4 text-sm font-semibold text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                    <tr class="border-b border-glass-border row-hover">
                        <td class="px-5 py-4">
                            <h2 class="font-medium text-white text-sm">{{ $item->borrower_name }}</h2>
                            <p class="text-xs text-slate-600 mt-0.5">ID #{{ $item->id }}</p>
                        </td>
                        <td class="px-5 py-4 text-slate-300 text-sm">
                            {{ $item->room->nama_ruangan ?? '-' }}
                        </td>
                        <td class="px-5 py-4">
                            @if($item->status == 'dipinjam')
                                <span class="inline-flex items-center gap-1.5 text-rose-400 text-xs font-medium bg-rose-500/10 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-rose-400 rounded-full dot-pulse"></span> Dipinjam
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-emerald-400 text-xs font-medium bg-emerald-500/10 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span> Dikembalikan
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-400">{{ $item->borrowed_at }}</td>
                        <td class="px-5 py-4 text-sm text-slate-400">
                            @if($item->returned_at)
                                {{ $item->returned_at }}
                            @else
                                <span class="text-slate-600 italic">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <form action="/riwayat/{{ $item->id }}" method="POST"
                                  onsubmit="return confirm('Hapus riwayat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-rose-600/80 hover:bg-rose-500 transition text-white px-3.5 py-1.5 rounded-lg text-xs font-medium">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-slate-600 text-sm">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="inbox" class="w-8 h-8 text-slate-700"></i>
                                Belum ada data peminjaman
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>lucide.createIcons();</script>
</body>
</html>