@extends('admin.app')
@section('title', "Edit Project")
@section('konten-title', "Edit Project")

@section('konten')

<a href="/masterproject"><button class="btn btn-success mb-3" type="submit">Kembali</button></a>

{{-- <div class="card shadow mb-4">
    <section>
        <div class="card-body">
            <form method="POST" action="{{route('masterproject.update', $data['id'])}}">
@csrf
@method('PUT')
<div class="form-group col-md-4">
    <label class="">Nama Siswa</label>
    <select class="form-control form-select" name="id_siswa" id="id_siswa">
        <option selected disabled>Pilih nama siswa</option>
        @foreach ($siswas as $siswa)
        <option value="{{$siswa->id}}" @if ($data->id_siswa == $siswa->id)selected
            @endif>{{$siswa->nama}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="col-md-4">Nama Project
        <input type="string" name="nama_projek" value="{{$data['nama_projek']}}" class="form-control">
    </label>
</div>
<div class="form-group">
    <label class="col-md-4">Deskripsi
        <input type="char" name="deskripsi" value="{{$data['deskripsi']}}" class="form-control">
    </label>
</div>
<div class="form-group">
    <label class="col-md-4">Foto
        <input type="char" name="foto" value="{{$data['foto']}}" class="form-control">
    </label>
</div>
<div class="form-group">
    <label class="col-md-4">Tanggal
        <input type="date" name="tanggal" value="{{$data['tanggal']}}" class="form-control">
    </label>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">EDIT</button>
</div>
</form>
</div>
</section>
</div> --}}
<div class="card shadow justify">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{route('masterproject.update', $projects->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="id_siswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                <div class="col-sm-5">
                    <select class="form-control form-select" name="id_siswa" id="id_siswa">
                        <option selected disabled>Pilih nama siswa</option>
                        @foreach ($siswas as $siswa)
                        <option value="{{$siswa->id}}" @if ($projects->id_siswa == $siswa->id)selected
                            @endif>{{$siswa->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_projek" class="col-sm-3 col-form-label">Nama Project</label>
                <div class="col-sm-5">
                    <input type="text" name="nama_projek" value="{{$projects->nama_projek}}" id="nama_projek"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-5">
                    <textarea type="text" name="deskripsi" id="deskripsi" rows="3"
                        class="form-control">{{$projects->deskripsi}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-sm-3 col-form-label">Foto Project</label>
                <div class="col-sm-5">
                    <div class="custom-file">
                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                        <input type="hidden" name="oldFoto" value="{{$projects->foto}}">
                        <div class="col-sm-5">
                            @if($projects->foto)
                            <img src="{{asset('images/admin/'. $projects->foto)}}"
                                class="img-preview img-fluid w-80 mt-5">
                            @else
                            <img class="img-preview img-fluid w-80 mt-5">
                            @endif
                        </div>
                        <input type="file" name="foto" class="custom-file-input" id="foto" onchange="previewImage()">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-5">
                    <input type="date" name="tanggal" value="{{$projects->tanggal}}" id="tanggal" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary mt-3" type="submit">EDIT</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector("#foto");
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endsection