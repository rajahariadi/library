@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-buildings'></i> Tambahkan Penerbit</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('penerbit.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Kode Penerbit</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kode Penerbit"
                            aria-describedby="defaultFormControlHelp" name="kode">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Nama Penerbit</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Nama Penerbit" aria-describedby="defaultFormControlHelp" name="nama">
                        </div>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Telepon Penerbit</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="defaultFormControlInput"
                                placeholder="Telepon Penerbit" aria-describedby="defaultFormControlHelp" name="telepon">
                        </div>
                        @error('telepon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Tambahkan Penerbit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
