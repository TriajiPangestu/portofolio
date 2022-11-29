@if (!$projeks->isEmpty())
<div class="row">
    @foreach ($projeks as $projek)
    <div class="col-md-12">
        <div class="card shadow mb-3 p-2">
            <div class="card-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-7">
                        <img src="{{ asset('images/admin/'. $projek->foto) }}" class="rounded w-100" alt="Foto Projek">
                    </div>
                    <div class="col-md-5">
                        <h5 class="text-dark font-weight-bold">{{ $projek->nama_projek }}</h5>
                        <p class="mt-3 mb-4 small">
                            {{ $projek->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 text-left">
                        <a href="{{route('masterproject.edit', $projek['id'])}}"
                            class="btn btn-circle btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                        <form method="POST" action="{{route('masterproject.destroy', $projek->id)}}"
                            onclick="return confirm('Apakah anda yakin akan menghapus project ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-circle btn-sm btn-danger" type="submit"><i
                                    class="fas fa-trash"></i></button></form>
                    </div>
                    <div class="col-md-6 text-right">
                        <small>
                            <span class="text-muted">
                                <b>Date : </b> {{ $projek->tanggal }}
                            </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif