@extends('layouts.app')

@section('konten')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Akun</h1>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role Id</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role_id }}</td>
                                    <td>
                                        @if ($item->status == 'approved')
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td class="action-buttons">
                                        <form action="{{ route('userManage.approve', ['id'=>$item->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('userManage.reject', ['id'=>$item->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('userManage.delete', ['id'=>$item->id]) }}" method="post" class="d-inline">
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