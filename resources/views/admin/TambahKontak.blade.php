@extends('admin.app')
@section('title', "Tambah Kontak")
@section('konten-title', "Tambah Kontak")
    
@section('konten')

<a href="/masterkontak"><button class="btn btn-success mb-3" type="submit">Kembali</button></a>

<div class="card shadow jutify">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{route('masterkontak.store')}}">
            @csrf
            <div class="form-group row">
                <label for="id_siswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                <div class="col-sm-5">
                    <input type="text" name="id_siswa" value="{{ old('nama_siswa', $siswas->nama) }}" class="form-control" id="id_siswa" @error ('nama_siswa') is-invalid @enderror>
                    <input type="hidden" name="nama_siswa" value="{{ $siswas->nama }}">
                    <input type="hidden" name="id_siswa" value="{{ $siswas->id }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="id_jenis" class="col-sm-3 col-form-label">Jenis Kontak</label>
                <div class="col-sm-5">
                    <select class="form-control" name="id_jenis">
                        @foreach ($kontaks as $item)
                            <option value="{{ $item->id }}">{{ $item->jenis_kontak }}</option>
                        @endforeach
                    </select>
                    @error('nama_projek')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
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