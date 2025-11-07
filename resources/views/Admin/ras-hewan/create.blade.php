@extends('layouts.app')
@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Ras Hewan</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_ras_hewan" class="form-label">
                                Nama Pet <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                    class="form-control @error('nama_ras_hewan') is-invalid @enderror"
                                    id="nama_ras_hewan"
                                    name="nama_ras_hewan"
                                    value="{{ old('nama_ras_hewan') }}"
                                    placeholder="Masukkan nama ras hewan"
                                    required>
                            @error('nama_ras_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
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
