@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-category'></i>Edit Penerbit</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('penerbit.update', $data->id) }}" method="POST" enctype="multipart/form-data"> @csrf
                        @method('PUT')
                        <label for="defaultFormControlInput" class="form-label">Kode Penerbit</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kode Penerbit"
                            aria-describedby="defaultFormControlHelp" name="kode" value="{{ $data->kode }}">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Nama Penerbit</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Nama Penerbit" aria-describedby="defaultFormControlHelp" name="nama"
                                value="{{ $data->nama }}">
                        </div>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Telepon Penerbit</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="defaultFormControlInput"
                                placeholder="Telepon Penerbit" aria-describedby="defaultFormControlHelp" name="telepon"
                                value="{{ $data->telepon }}">
                        </div>
                        @error('telepon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
