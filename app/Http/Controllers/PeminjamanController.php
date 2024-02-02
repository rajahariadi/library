<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\ListPeminjaman;
use App\Models\Member;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::select();
        return view('admin.peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['member'] = Member::select();
        $data['buku'] = Buku::select();
        return view('admin.peminjaman.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $peminjamanData = $request->except('_token', 'buku_id');
        $peminjaman = Peminjaman::store($peminjamanData);
        $bukuData = $request->input('buku_id', []);
        foreach ($bukuData as $buku) {
            $listPeminjamanBuku =
                [
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => $buku,
                ];
            ListPeminjaman::store($listPeminjamanBuku);
            Buku::pinjam($buku);
        }
        return redirect('peminjaman')->with('msgCreate', 'Peminjaman berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $tglKembali = Peminjaman::find($id)->tgl_kembali;

        if ($tglKembali == null) {
            $tanggalSekarang = Carbon::now()->toDateString();
            Peminjaman::find($id)->update(['tgl_kembali' => $tanggalSekarang]);

            // Call the updated kembali method in Buku model
            Buku::kembali($id);

            return redirect('peminjaman')->with('msgCreate', 'Buku berhasil dikembalikan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Peminjaman::find($id);
        $data['ListPeminjaman'] = ListPeminjaman::where('peminjaman_id', $id)->get();
        $data['member'] = Member::select();
        $data['buku'] = Buku::select();
        return view('admin.peminjaman.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peminjamanData = $request->except('_token', 'buku_id');
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update($peminjamanData);

        ListPeminjaman::where('peminjaman_id', $id)->delete();
        $bukuData = $request->input('buku_id', []);
        foreach ($bukuData as $buku) {
            $listPeminjamanBuku =
                [
                    'peminjaman_id' => $peminjaman->id,
                    'buku_id' => $buku,
                ];
            ListPeminjaman::create($listPeminjamanBuku);
        }

        return redirect('peminjaman')->with('msgCreate', 'Peminjaman berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapusPeminjaman = Peminjaman::del($id);
        $hapuslistPeminjaman =  ListPeminjaman::del($id);

        return redirect('peminjaman')->with('msgDelete', 'Peminjaman berhasil dihapus');
    }

    public function dtPeminjaman()
    {
        $data = Peminjaman::query()->with(['members', 'bukus']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('buku_judul', function ($data) {
                $bukus = $data->bukus;
                $judul = '';
                foreach ($bukus as $buku) {
                    $judul .= $buku->judul . ', ';
                }
                return rtrim($judul, ', ');
            })
            ->addColumn('aksi', function ($data) {
                $button = '';

                if (is_null($data->tgl_kembali)) {
                    $button .= '<a href="' . route('peminjaman.show', $data->id) . '" class="btn btn-success btn-md m-1"> Kembalikan Buku</a>';
                }

                $button .= '<form action="' . route('peminjaman.destroy', $data->id) . '" method="POST">
                ' . @csrf_field() . '
                ' . @method_field('DELETE') . '
                    <a class="btn btn-primary btn-md" href="' . route('peminjaman.edit', $data->id) . '"><i class="bx bx-edit"></i>Edit</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal' . $data->id . '">
                        <i class="bx bx-trash"></i>Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleVerticallycenteredModal' . $data->id . '" tabindex="-1" style="display: none;" aria-hidden="true">
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
                </form>';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
}
