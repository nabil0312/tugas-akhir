<!DOCTYPE html>
<html>
<head>
    <title>Struk Peminjaman</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

<div class="bg-white w-[320px] p-6 shadow-lg rounded-lg text-center">

    <h1 class="text-xl font-bold mb-4">
        SISTEM PEMINJAMAN
    </h1>

    <hr class="mb-4">

    <div class="text-left space-y-2 text-sm">

        <p>
            <strong>Nama:</strong>
            {{ $borrow->borrower_name }}
        </p>

        <p>
            <strong>Ruangan:</strong>
            {{ $borrow->room->nama_ruangan }}
        </p>

        <p>
            <strong>Waktu:</strong>
            {{ $borrow->borrowed_at }}
        </p>

    </div>

    <div class="flex justify-center my-5">

        {!! QrCode::size(180)->generate($borrow->id) !!}

    </div>

    <p class="text-sm text-gray-500">
        Scan QR ini untuk pengembalian ruangan
    </p>

    <hr class="my-4">

    <p class="text-xs text-gray-400">
        Terima kasih
    </p>

</div>

<script>

window.print();

</script>

</body>
</html>