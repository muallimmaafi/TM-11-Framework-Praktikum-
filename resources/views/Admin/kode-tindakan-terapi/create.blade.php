@extends('layouts.app')
@section('title', 'Tambah Kode Tindakan Terapi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Kode Tindakan Terapi</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_kode-tindakan-terapi" class="form-label">
                                Nama Kode Tindakan Terapi <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                    class="form-control @error('nama_kode_tindakan_terapi') is-invalid @enderror"
                                    id="nama_kode_tindakan_terapi"
                                    name="nama_kode_tindakan_terapi"
                                    value="{{ old('nama_kode_tindakan_terapi') }}"
                                    placeholder="Masukkan nama kode tindakan terapi"
                                    required>
                            @error('nama_kode_tindakan_terapi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
