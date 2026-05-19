<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    @vite('resources/css/app.css')

    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: white;
            font-family: Arial, sans-serif;
        }

        .receipt {
            width: 220px;
            padding: 10px;
            margin: auto;
        }

        @media print {
            html, body {
                width: 80mm;
                height: auto;
                overflow: hidden;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="receipt text-center">

    <!-- TITLE -->
    <h1 class="text-sm font-bold">
        📚 SISTEM PEMINJAMAN
    </h1>

    <p class="text-[10px] text-gray-500 mb-2">
        Struk Peminjaman Ruangan
    </p>

    <hr class="mb-2 border-black">

    <!-- INFO -->
    <div class="text-left space-y-1 text-[11px]">

        <p>
            <strong>Nama :</strong>
            {{ $borrowing->borrower_name }}
        </p>

        <p>
            <strong>Ruangan :</strong>
            {{ $borrowing->room->nama_ruangan ?? '-' }}
        </p>

        <p>
            <strong>Waktu Pinjam :</strong>
            {{ $borrowing->start_time }}
        </p>

        <p>
            <strong>Batas Waktu :</strong>
            {{ $borrowing->end_time }}
        </p>

    </div>

    <!-- QR -->
    <div class="flex justify-center my-3">
        {!! QrCode::size(80)->generate($borrowing->id) !!}
    </div>

    <!-- TEXT -->
    <p class="text-[10px] text-gray-500">
        Scan QR untuk pengembalian
    </p>

    <hr class="my-2 border-black">

    <!-- FOOTER -->
    <p class="text-[9px] text-gray-400">
        Terima kasih telah menggunakan sistem peminjaman. Struk jangan sampai hilang agar dapat melakukan pengembalian ruangan
    </p>
    <p class="text-[10px] font-bold text-red-600 mt-2 border border-red-600 p-1 border-dashed">
        ⚠️ PERINGATAN:<br>
        Denda keterlambatan pengembalian Rp. 10.000 / jam
    </p>

</div>

<div class="text-center mt-4 print:hidden">
    <a href="/dashboard"
       style="display:inline-block; background:#2563eb; color:#fff; padding:10px 24px; border-radius:8px; text-decoration:none; font-size:14px; font-family:Arial,sans-serif;">
        ← Kembali ke Dashboard
    </a>
</div>

</body>
</html>