<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::select();
        return view('admin.kategori.index', compact('data')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        $data = $request->except('_token');
        $kategori = Kategori::store($data);
        return redirect('kategori')->with('msgCreate','Kategori Berhasil dibuat');
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
        $data = Kategori::find($id);
        return view ('admin.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, string $id)
    {
        $data = $request->except('_token');
        $kategori = Kategori::upd($id,$data);
        return redirect('kategori')->with('msgCreate','Kategori Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Kategori::del($id);
        return redirect('kategori')->with('msgDelete','Kategori Berhasil dihapus');
    }

    public function dtKategori()
    {
        $data = Kategori::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $button = '<form action=" ' . route('kategori.destroy', $data->id)  . '" method="POST">
                ' . @csrf_field() . '
                ' . @method_field('DELETE') . '
                <a class="btn btn-primary btn-md"
                href=" ' . route('kategori.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"><i class="bx bx-trash"></i>Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Apakah anda yakin ingin menghapus kategori ini ?</div>
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
