@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-group'></i> Tambahkan Member</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Username</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Username"
                            aria-describedby="defaultFormControlHelp" name="username">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Nama Member</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Nama Member" aria-describedby="defaultFormControlHelp" name="nama">
                        </div>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="defaultFormControlInput"
                                placeholder="Password" aria-describedby="defaultFormControlHelp" name="password">
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Alamat</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Alamat"
                                aria-describedby="defaultFormControlHelp" name="alamat">
                        </div>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">HP</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="defaultFormControlInput" placeholder="HP"
                                aria-describedby="defaultFormControlHelp" name="hp">
                        </div>
                        @error('hp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Email"
                                aria-describedby="defaultFormControlHelp" name="email">
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <input hidden type="text" class="form-control" id="defaultFormControlInput" placeholder="Status"
                            aria-describedby="defaultFormControlHelp" name="status" value="Aktif">
                        <a href="{{ route('member.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Tambahkan Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
