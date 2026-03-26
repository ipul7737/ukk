<h2>Daftar Peminjaman Saya</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
    </tr>

    @foreach($loans as $loan)
    <tr>
        <td>{{ $loan->book->judul }}</td>
        <td>{{ $loan->tanggal_pinjam }}</td>
        <td>{{ $loan->status }}</td>
    </tr>
    @endforeach
</table>