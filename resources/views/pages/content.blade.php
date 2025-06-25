@extends('layouts.app')

@section('konten')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: "Success",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            </script>
        @endif
    </div>
@endsection
