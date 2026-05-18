<!DOCTYPE html>
<html>
<head>
    <title>RFID Peminjaman</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

    <h1 class="text-2xl font-bold text-center mb-6">
        📡 Scan RFID
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="/rfid" method="POST">
        @csrf

        <!-- KOLOM NAMA -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Nama Peminjam
            </label>

            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama..."
                class="w-full border p-3 rounded-xl"
                required
            >
        </div>

        <!-- RFID -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Tempel Kartu RFID
            </label>

            <input
                type="text"
                name="rfid_uid"
                placeholder="Scan RFID..."
                autofocus
                class="w-full border p-3 rounded-xl"
                required
            >
        </div>

        <!-- ROOM -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Pilih Ruangan
            </label>

            <select
                name="room_id"
                class="w-full border p-3 rounded-xl"
            >

                @foreach($rooms as $room)

                    <option value="{{ $room->id }}">
                        {{ $room->nama_ruangan }}
                    </option>

                @endforeach

            </select>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-xl font-semibold transition"
        >
            Pinjam Ruangan
        </button>

    </form>

</div>

</body>
</html>