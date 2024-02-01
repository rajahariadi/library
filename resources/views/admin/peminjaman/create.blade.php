@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-transfer'></i> Tambahkan Peminjaman</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <label class="form-label">Member</label>
                        <select class="single-select" name="member_id">
                            <option selected value="">-- Pilih --</option>
                            @foreach ($data['member'] as $member)
                                <option value="{{ $member->id }}">{{ $member->nama }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label class="form-label">Buku</label>
                        <select class="multiple-select" multiple="multiple" name="buku_id[]">
                            @foreach ($data['buku'] as $buku)
                                <option value="{{ $buku->id }}" >{{ $buku->judul }}</option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Tanggal Peminjaman</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" name="tgl_pinjam">
                        </div>
                        @error('tgl_pinjam')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Tenggat Pengembalian</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" name="tgl_tenggat">
                        </div>
                        @error('tgl_tenggat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Tambahkan Peminjaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
