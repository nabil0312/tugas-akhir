<!DOCTYPE html>
<html>
<head>
    <title>Scan Pengembalian</title>

    <script src="https://unpkg.com/html5-qrcode"></script>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">

<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

    <h1 class="text-2xl font-bold text-center mb-6">
        📷 Scan QR Struk
    </h1>

    <p class="text-gray-500 text-center mb-6">
        Scan QR pada struk untuk mengembalikan ruangan
    </p>

    @if(session('error'))

        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>

    @endif

    <!-- CAMERA -->
    <div id="reader"></div>

    <!-- FORM -->
    <form id="form" method="POST" action="/return-scan">

        @csrf

        <input type="hidden" name="kode" id="kode">

    </form>

</div>

<script>

function onScanSuccess(decodedText) {

    document.getElementById('kode').value = decodedText;

    document.getElementById('form').submit();

}

new Html5QrcodeScanner(
    "reader",
    {
        fps: 10,
        qrbox: 250
    }
).render(onScanSuccess);

</script>

</body>
</html>