@extends('layouts.murid')

@section('content')

<div class="container">

<h3>Riwayat Peminjaman</h3>

<table class="table table-bordered">

<thead>
<tr>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($loans as $loan)

<tr>
<td>{{ $loan->book->title }}</td>
<td>{{ $loan->tanggal_pinjam }}</td>
<td>{{ $loan->status }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

@endsection
