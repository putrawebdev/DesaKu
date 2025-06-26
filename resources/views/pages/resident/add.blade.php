@extends('layouts.app')
@section('konten')
    {{-- page heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($residentFind)? 'Edit Data Penduduk':'Tambah Data Penduduk' }}</h1>
    </div>


    <div class="row">
        <div class="col">
            <form action="{{ isset($residentFind)? route('resident.update', ['id'=>$residentFind->id]):route('resident.store') }}" method="post">
                @csrf
                @if (isset($residentFind))
                    @method('put')
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="number" inputmode="numeric" name="nik" id="nik" class="form-control" value="{{ old('nik', $residentFind->nik ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $residentFind->name ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control" value="{{ old('gender', $residentFind->gender ??'') }}">
                                <option value="male">Laki-Laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $residentFind->birth_date ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_place">Tempat Lahir</label>
                            <input type="text" name="birth_place" id="birth_place" class="form-control" value="{{ old('birth_place', $residentFind->birth_place ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" cols="30" rows="10" class="form-control" value="">{{ old('address', $residentFind->address ??'') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="religion">Agama</label>
                            {{-- <input type="text" name="religion" id="religion" class="form-control"> --}}
                            <select type="text" name="religion" id="religion" class="form-control" value="{{ old('religion', $residentFind->religion ??'') }}">
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katholik">Kristen Katholik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Buddha</option>
                                <option value="KongHuchu">KongHuchu</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="marital_status">Status Perkawinan</label>
                            <select name="marital_status" id="marital_status" class="form-control" value="{{ old('marital_status', $residentFind->marital_status ??'') }}">
                                <option value="single">Belum Menikah</option>
                                <option value="married">Menikah</option>
                                <option value="divorced">Cerai</option>
                                <option value="widowed">Janda/Duda</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="occupation">Pekerjaan</label>
                            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ old('occupation', $residentFind->occupation ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Nomor Telepon</label>
                            <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone', $residentFind->phone ??'') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status Penduduk</label>
                            <select name="status" id="status" class="form-control" value="{{ old('status', $residentFind->status ??'') }}">
                                <option value="active">Aktif</option>
                                <option value="moved">Pindahan</option>
                                <option value="deceased">Meninggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px">
                            <a href="{{ route('resident.index') }}" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-outline-dark">{{ isset($residentFind)? 'Edit':'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection