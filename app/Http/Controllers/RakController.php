<?php

namespace App\Http\Controllers;

use App\Http\Requests\RakRequest;
use App\Models\Rak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rak::select();
        return view('admin.rak.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RakRequest $request)
    {
        $data = $request->except('_token');
        $rak = Rak::store($data);
        return redirect('rak')->with('msgCreate', 'Rak berhasil dibuat');
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
        $data = Rak::find($id);
        return view ('admin.rak.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RakRequest $request, string $id)
    {
        $data = $request->except('_token');
        $rak = Rak::upd($id,$data);
        return redirect('rak')->with('msgCreate','Rak berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Rak::del($id);
        return redirect('rak')->with('msgDelete', 'Rak berhasil dihapus');
    }

    public function dtRak()
    {
        $data = Rak::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $button = '<form action=" ' . route('rak.destroy', $data->id)  . '" method="POST">
                ' . @csrf_field() . '
                ' . @method_field('DELETE') . '
                <a class="btn btn-primary btn-md"
                href=" ' . route('rak.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal' . $data->id . '"><i class="bx bx-trash"></i>Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal' . $data->id . '" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Apakah anda yakin ingin menghapus rak ini ?</div>
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
