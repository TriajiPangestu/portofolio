@if (!$kontaks->isEmpty())
<div class="row">
    @foreach ($kontaks as $kontak)
    <div class="col-md-4">
        <div class="card shadow mb-3 p-2">
            <div class="card-body m-1">
                <h5 class="font-weight-bold">
                    <i class="fab fa-{{strtolower($kontak->jenis_kontak->jenis_kontak)}}"></i>
                {{ $kontak->deskripsi }}
                </h5>
            </div>
            <div class="card-footer">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 text-left">
                        <a href="{{route('masterkontak.edit', $kontak['id'])}}"
                            class="btn btn-circle btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                        <form method="POST" action="{{route('masterkontak.destroy', $kontak->id)}}"
                            onclick="return confirm('Apakah anda yakin akan menghapus project ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-circle btn-sm btn-danger" type="submit"><i
                                    class="fas fa-trash"></i></button></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif