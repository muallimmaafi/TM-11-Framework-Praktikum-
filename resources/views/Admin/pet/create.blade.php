@extends('layouts.app')
@section('title', 'Tambah Pet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Pet</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.pet.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_pet" class="form-label">
                                Nama Pet <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                    class="form-control @error('nama_pet') is-invalid @enderror"
                                    id="nama_pet"
                                    name="nama_pet"
                                    value="{{ old('nama_pet') }}"
                                    placeholder="Masukkan nama pet"
                                    required>
                            @error('nama_pet')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
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
