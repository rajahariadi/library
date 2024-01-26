@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-cabinet'></i> Tambahkan Rak</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('rak.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Kode Rak</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kode Rak"
                            aria-describedby="defaultFormControlHelp" name="kode">
                        @error('kode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Nama Rak</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Nama Rak" aria-describedby="defaultFormControlHelp" name="nama">
                        </div>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('rak.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Tambahkan Rak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
