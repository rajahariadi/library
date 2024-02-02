@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-transfer'></i>Data Peminjaman</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary"><i
                                        class='bx bx-add-to-queue'></i>Tambahkan Peminjaman</a>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        @if (session('msgCreate'))
                            <div class ="col-lg-4">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('msgCreate') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if (session('msgDelete'))
                            <div class ="col-lg-4">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('msgDelete') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <table id="myTable"
                                class="table table-striped table-bordered dataTable text-center align-middle"
                                style="width: 100%;" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">No</th>
                                        <th>Member</th>
                                        <th>Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tenggat Pengembalian</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th class="col-lg-2">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($data as $peminjaman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $peminjaman->member->nama }}</td>
                                            <td>
                                                @foreach ($peminjaman->listpeminjaman as $listPeminjaman)
                                                    {{ $listPeminjaman->buku->judul }},
                                                @endforeach
                                            </td>
                                            <td>{{ $peminjaman->tgl_pinjam }}</td>
                                            <td>{{ $peminjaman->tgl_tenggat }}</td>
                                            <td>{!! $peminjaman->status !!}</td>
                                            <td>{{ $peminjaman->tgl_kembali }}</td>
                                            <td>
                                          @if (is_null($peminjaman->tgl_kembali))
                                          <a href="{{ route('peminjaman.show', $peminjaman->id ) }}"  class="btn btn-success btn-md m-1"> Kembalikan Buku</a>
                                          @endif
                                                <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST"> @csrf @method ('DELETE')
                                                    <a class="btn btn-primary btn-md" href="{{ route('peminjaman.edit', $peminjaman->id) }}"><i class="bx bx-edit"></i>Edit</a>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal{{ $peminjaman->id }}">
                                                        <i class="bx bx-trash"></i>Delete
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleVerticallycenteredModal{{ $peminjaman->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">Apakah anda yakin ingin menghapus peminjaman ini ?</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- DATA DARI DATA TABLE --}}
@section('myscript')
    <script>
        var dtTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                className: 'text-center',
                targets: ['_all']
            }, ],
            ajax: '{{ route('peminjaman.dt') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'members.nama',
                    name: 'members.nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'buku_judul',
                    name: 'buku_judul',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'tgl_tenggat',
                    name: 'tgl_tenggat',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        if (data === 'Sudah Dikembalikan') {
                            return '<span class="badge bg-info">' + data + '</span>';
                        } else {
                            if (data === 'Dipinjam') {
                                return '<span class="badge bg-secondary">' + data + '</span>';
                            } else {
                                return '<span class = "badge bg-danger" >' + data + '</span>';

                            }
                        }
                    }
                },
                {
                    data: 'tgl_kembali',
                    name: 'tgl_kembali',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    </script>
@endsection
