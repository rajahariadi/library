@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-book'></i> Edit Buku</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('buku.update',$data->id) }}" method="POST" enctype="multipart/form-data"> @csrf @method('PUT')
                        <label class="form-label">Kategori</label>
                        <select class="single-select" name="kategori_id">
                            @foreach ($data['kategori'] as $kategori)
                                <option value="{{ $kategori->id }}" {{ $data->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label class="form-label">Penerbit</label>
                        <select class="single-select" name="penerbit_id">
                            <option selected>-- Pilih --</option>
                            @foreach ($data['penerbit'] as $penerbit)
                                <option value="{{ $penerbit->id }}" {{ $data->penerbit_id == $penerbit->id ? 'selected' : '' }}>{{ $penerbit->nama }}</option>
                            @endforeach
                        </select>
                        @error('penerbit_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label class="form-label">Rak</label>
                        <select class="single-select" name="rak_id">
                            <option selected>-- Pilih --</option>
                            @foreach ($data['rak'] as $rak)
                                <option value="{{ $rak->id }}" {{ $data->rak_id == $rak->id ? 'selected' : '' }}>{{ $rak->nama }}</option>
                            @endforeach
                        </select>
                        @error('rak_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Judul Buku</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Judul Buku"
                                aria-describedby="defaultFormControlHelp" name="judul" value="{{ $data->judul }}">
                        </div>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Pengarang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Pengarang"
                                aria-describedby="defaultFormControlHelp" name="pengarang" value="{{ $data->pengarang }}">
                        </div>
                        @error('pengarang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Stok Buku</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="defaultFormControlInput" placeholder="Stok Buku"
                                aria-describedby="defaultFormControlHelp" name="stok" value="{{ $data->stok }}">
                        </div>
                        @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="gambarBukuInput" class="form-label">Gambar Buku</label>
                        <input  type="file" accept="image/png, image/jpeg" class="form-control" id="gambarBukuInput" placeholder="Gambar Buku"
                            aria-describedby="defaultFormControlHelp" name="gambar" onchange="previewImage(this)">
                        @error('gambar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <br><br><br>
                        <img class="text-center" id="gambarBukuPreview" src="{{ asset('storage/' . $data->gambar) }}"
                            style="max-width: 100%; height: 500px;   margin:auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
