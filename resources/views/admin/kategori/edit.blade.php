@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-category'></i>Edit Kategori</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('kategori.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <label for="defaultFormControlInput" class="form-label">Kode Kategori</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kode Kategori"
                            aria-describedby="defaultFormControlHelp" name="kode" value="{{ $data->kode }}">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Nama Kategori</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Nama Kategori" aria-describedby="defaultFormControlHelp" name="nama"
                                value="{{ $data->nama }}">
                        </div>
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
