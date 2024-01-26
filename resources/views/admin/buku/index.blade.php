@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-book'></i>Data Buku</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <a href="{{ route('buku.create') }}" class="btn btn-primary"><i
                                        class='bx bx-add-to-queue'></i>Tambahkan Buku</a>
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
                                        <th>Kategori</th>
                                        <th>Penerbit</th>
                                        <th>Rak</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                        <th class="col-lg-2">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- DATA DARI DATA TABLE --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
            ajax: '{{ route('buku.dt') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kategoris.nama',
                    name: 'kategoris.nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'penerbits.nama',
                    name: 'penerbits.nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'raks.nama',
                    name: 'raks.nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'judul',
                    name: 'judul',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'pengarang',
                    name: 'pengarang',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'stok',
                    name: 'stok',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'gambar',
                    name: 'gambar',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        return '<a href="{{ asset('storage/') }}/' + data +
                            '"><img src="{{ asset('storage/') }}/' + data + '"alt="' + full.nama +
                            '" style="max-width:100px; max-height:100px;"/></a>';
                    }
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
