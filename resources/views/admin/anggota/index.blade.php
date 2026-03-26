@extends('layouts.admin')

@section('content')

<style>
table {
  border-spacing: 0;
  border-radius: 20px;
  overflow: hidden;
}

.table-light-primary, .table-light-primary > th, .table-light-primary > td {
    background-color: #0d6efd !important;
    color: #ffffff;
}
</style>

<h2 class="mb-4">Data Anggota</h2>
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah Anggota</a>
    <form method="GET" action="{{ route('anggota.index') }}" style="width:300px;">
        <div class="input-group"><input type="text" name="search" class="form-control" placeholder="Cari NISN..,Nama..,Email.." value="{{ request('search') }}">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="table-light-primary">
            <th>NISN</th>
            <th>Nama</th>
            <th>Email</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->nisn }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('anggota.edit',$user->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('anggota.destroy',$user->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
