<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\ListPeminjaman;
use App\Models\Member;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
