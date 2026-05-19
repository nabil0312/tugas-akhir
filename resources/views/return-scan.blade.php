<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Pengembalian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-dark-950 min-h-screen flex justify-center items-center p-4">

<div class="card p-8 sm:p-10 rounded-2xl w-full max-w-md fade-in" id="return-form-container">

    <a href="/dashboard" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-400 transition text-sm font-medium mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>

    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center">
            <i data-lucide="qr-code" class="w-5 h-5 text-amber-400"></i>
        </div>
        <h1 class="text-2xl font-bold text-white">Scan Barcode</h1>
    </div>
    <p class="text-slate-500 mb-8 text-sm">Scan barcode pada struk untuk mengembalikan ruangan</p>

    @if(session('error'))
        <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-3.5 rounded-xl mb-4 text-sm font-medium flex items-center gap-2" id="alert-error">
            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl mb-4 p-4 flex items-center gap-2 text-emerald-400 font-medium text-sm" id="alert-success">
            <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/return-scan" id="return-form">
        @csrf

        <div class="mb-6">
            <label class="flex items-center gap-2 mb-2 font-medium text-sm text-slate-400" for="kode">
                <i data-lucide="scan-barcode" class="w-4 h-4"></i> Barcode / QR Code
            </label>
            <input type="text" name="kode" id="kode" autofocus autocomplete="off"
                placeholder="Scan barcode di sini..."
                onkeydown="return event.key != 'Enter';"
                class="w-full bg-dark-800 border border-glass-border text-white placeholder-slate-600 focus:border-amber-500 focus:outline-none rounded-xl px-4 py-4 text-lg font-semibold text-center transition">
        </div>

        <button type="submit" id="btn-submit"
            class="w-full flex items-center justify-center gap-2 bg-amber-600 hover:bg-amber-500 transition text-white py-3.5 rounded-xl font-semibold text-base">
            <i data-lucide="undo-2" class="w-4 h-4"></i> Kembalikan Ruangan
        </button>
    </form>

    <div class="mt-6 flex items-center justify-center gap-2 text-slate-600 text-sm">
        <i data-lucide="info" class="w-4 h-4"></i>
        <p>Arahkan scanner ke QR pada struk</p>
    </div>

</div>

<script>lucide.createIcons();</script>
</body>
</html>