@extends('admin.app')
@section('title', "Edit Kontak")
@section('konten-title', "Edit Kontak")
    
@section('konten')

<a href="/masterkontak"><button class="btn btn-success mb-3" type="submit">Kembali</button></a>

<div class="card shadow jutify">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{route('masterkontak.update', $kontaks->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" name="deskripsi" value="{{ $kontaks->deskripsi }}" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary mt-3" type="submit">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

@endsection