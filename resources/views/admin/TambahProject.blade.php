@extends('admin.app')
@section('title', "Tambah Project")
@section('konten-title', "Tambah Project")
    
@section('konten')

<a href="/masterproject"><button class="btn btn-success mb-3" type="submit">Kembali</button></a>

<div class="card shadow jutify">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{route('masterproject.store')}}">
            @csrf
            <div class="form-group row">
                <label for="id_siswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                <div class="col-sm-5">
                    <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswas->nama) }}" class="form-control" id="id_siswa" @error ('nama_siswa') is-invalid @enderror>
                    <input type="hidden" name="nama_siswa" value="{{ $siswas->nama }}">
                    <input type="hidden" name="id_siswa" value="{{ $siswas->id }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_project" class="col-sm-3 col-form-label">Nama Project</label>
                <div class="col-sm-5">
                    <input type="text" name="nama_project" id="nama_project" class="form-control @error('nama_project') is-invalid @enderror"> 
                    @error('nama_project')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-5">
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-sm-3 col-form-label">Foto Project</label>
                <div class="col-sm-5">
                    <div class="custom-file">
                        <label class="custom-file-label" for="foto">Pilih foto project</label>
                        <div class="col-sm-5">
                            <img class="img-preview img-fluid w-80 mt-5">
                        </div>
                        <input type="file" name="foto" class="custom-file-input" id="foto" onchange="previewImage()">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-5">
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                    @error('tanggal')
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


<script>
    function previewImage(){
        const image = document.querySelector("#foto");
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection