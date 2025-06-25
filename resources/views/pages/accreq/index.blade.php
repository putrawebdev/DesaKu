@extends('layouts.app')

@section('konten')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
    </div>
    

    {{-- list tabel --}}
    <div class="row">
        <div class="col">
            @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Success",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                </script>
            @endif
            @if ($errors->any())
                
                @foreach ($errors->all() as $error)
                    <script>
                        Swal.fire({
                            title: "Something wrong!",
                            text: "{{ $error }}{{ $loop->last? '.' : ', ' }}",
                            icon: "error"
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role_id }}</td>
                                    <td>
                                        @if ($item->status == 'submitted')
                                            <span class="badge badge-warning">Meminta Akses</span>
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <form action="{{ route('accreq.approve', ['id'=>$item->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('accreq.reject', ['id'=>$item->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-xmark"></i>
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