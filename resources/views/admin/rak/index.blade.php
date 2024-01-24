@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-cabinet'></i>Data Rak</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <a href="{{ route('rak.create') }}" class="btn btn-primary"><i
                                        class='bx bx-add-to-queue'></i>Tambahkan Rak</a>
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
                                        <th>Kode</th>
                                        <th>Rak</th>
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
            ajax: '{{ route('rak.dt') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode',
                    name: 'kode',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'nama',
                    name: 'nama',
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
