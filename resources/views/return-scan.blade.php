<!DOCTYPE html>
<html>
<head>
    <title>Scan Pengembalian</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex justify-center items-center p-4">

<div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">

    <!-- HEADER -->
    <div class="text-center mb-6">

        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
            🔫 Scan Barcode Struk
        </h1>

        <p class="text-gray-500 text-sm">
            Scan barcode menggunakan scanner untuk mengembalikan ruangan
        </p>

    </div>

    <!-- ALERT -->
    @if(session('error'))

        <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mb-4 text-sm">
            ❌ {{ session('error') }}
        </div>

    @endif

    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-xl mb-4 text-sm">
            ✅ {{ session('success') }}
        </div>

    @endif

    <!-- FORM -->
    <form method="POST" action="/return-scan">

        @csrf

        <!-- INPUT SCANNER -->
        <div class="mb-5">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Barcode / QR Code
            </label>

            <input
                type="text"
                name="kode"
                autofocus
                autocomplete="off"
                placeholder="Scan barcode di sini..."
                class="w-full border-2 border-gray-200 focus:border-indigo-500 focus:ring-0 rounded-2xl px-4 py-4 text-lg font-bold text-center outline-none"
            >

        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 transition text-white py-4 rounded-2xl font-bold text-lg shadow-lg"
        >
            Kembalikan Ruangan
        </button>

    </form>

    <!-- INFO -->
    <div class="mt-6 text-center text-sm text-gray-400">

        <p>
            💡 Arahkan scanner ke QR pada struk
        </p>

    </div>

</div>

</body>
</html>