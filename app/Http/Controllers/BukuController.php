<?php

namespace App\Http\Controllers;

use App\Http\Requests\BukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::selRelasi();
        return view('admin.buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kategori'] = Kategori::select();
        $data['penerbit'] = Penerbit::select();
        $data['rak'] = Rak::select();
        $data['mode'] = 'create';
        return view('admin.buku.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request)
    {
        $data = $request->except('_token');
        $data['gambar'] = $request->file('gambar')->store('gambarBuku', 'public');
        $buku = Buku::store($data);
        return redirect('buku')->with('msgCreate', 'Buku berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Buku::find($id);
        $data['kategori'] = Kategori::select();
        $data['penerbit'] = Penerbit::select();
        $data['rak'] = Rak::select();
        $data['mode'] = 'edit';

        return view('admin.buku.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BukuRequest $request, string $id)
    {
        $data = $request->except('_token');
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambarBuku', 'public');
        }
        $buku = Buku::upd($id, $data);
        return redirect('buku')->with('msgCreate', 'Buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Buku::del($id);
        return redirect('buku')->with('msgDelete', 'Buku berhasil dihapus');
    }

    public function dtBuku()
    {
        $data = Buku::query()
            ->with(['kategoris', 'penerbits', 'raks']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $button = '<form action=" ' . route('buku.destroy', $data->id)  . '" method="POST">
            ' . @csrf_field() . '
            ' . @method_field('DELETE') . '
            <a class="btn btn-primary btn-md"
            href=" ' . route('buku.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
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
                        <div class="modal-body">Apakah anda yakin ingin menghapus buku ini ?</div>
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
