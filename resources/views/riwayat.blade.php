<h1>Riwayat Peminjaman</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Ruangan</th>
        <th>Status</th>
        <th>Waktu Pinjam</th>
        <th>Waktu Kembali</th>
    </tr>

    @foreach($history as $item)
    <tr>
        <td>{{ $item->borrower_name }}</td>
        <td>{{ $item->room->nama_ruangan }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->borrowed_at }}</td>
        <td>{{ $item->returned_at ?? '-' }}</td>
    </tr>

    <td>
    @if($item->status == 'dipinjam')
        <span style="color:red;">Dipinjam</span>
    @else
        <span style="color:green;">Dikembalikan</span>
    @endif
    </td>
    @endforeach
</table>