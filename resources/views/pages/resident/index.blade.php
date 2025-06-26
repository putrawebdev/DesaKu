@extends('layouts.app')

@section('konten')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="{{ route('resident.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm"><i
            class="fas fa-plus fa-sm text-dark"></i> Tambah Data</a>
    </div>
    

    {{-- list tabel --}}
    <div class="row">
        <div class="col">
            @if (session('success'))
                <script>
                    Swal.fire({
                        position: "top-end",
                        title: "{{ session('success') }}",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1300
                    });
                </script>
            @endif
            @if ($errors->any())
                
                @foreach ($errors->all() as $error)
                    <script>
                        Swal.fire({
                            position: "top-end",
                            title: "{{ $error }}{{ $loop->last? '.' : ', ' }}",
                            // text: "{{ $error }}{{ $loop->last? '.' : ', ' }}",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1300
                        });
                    </script>
                @endforeach
                
            @endif
            
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>Telepon</th>
                                <th>Status Penduduk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($residents as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->birth_place }}, {{ $item->birth_date }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->religion }}</td>
                                    <td>{{ $item->marital_status }}</td>
                                    <td>{{ $item->occupation }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-sm btn-warning">
                                            <a href="{{ route('resident.edit', ['id'=>$item->id]) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </button>
                                        <form action="{{ route('resident.delete', ['id'=>$item->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection