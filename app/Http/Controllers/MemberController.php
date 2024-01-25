<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Member::select();
        return view('admin.member.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $data = $request->except('_token');
        $member = Member::store($data);
        return redirect('member')->with('msgCreate', 'Member berhasil dibuat');
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
        $data = Member::find($id);
        return view('admin.member.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, string $id)
    {
        $data = $request->except('_token');
        $member = Member::upd($id, $data);
        return redirect('member')->with('msgCreate', 'Member berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Member::del($id);
        return redirect('member')->with('msgDelete', 'Member berhasil dihapus');
    }

    public function dtMember()
    {
        $data = Member::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $button = '<form action=" ' . route('member.destroy', $data->id)  . '" method="POST">
                ' . @csrf_field() . '
                ' . @method_field('DELETE') . '
                <a class="btn btn-primary btn-md"
                href=" ' . route('member.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
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
                            <div class="modal-body">Apakah anda yakin ingin menghapus member ini ?</div>
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
