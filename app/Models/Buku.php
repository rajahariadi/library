<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function kategoris(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function penerbits(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id', 'id');
    }

    public function raks(): BelongsTo
    {
        return $this->belongsTo(Rak::class, 'rak_id', 'id');
    }

    public static function selRelasi()
    {
        return Buku::query()
            ->with(['kategoris', 'penerbits', 'raks'])
            ->get()
            ->toArray();
    }

    public static function updRelasi($id)
    {
        return Buku::query()
            ->with(['kategoris', 'penerbits', 'raks'])
            ->where('id', $id)
            ->get()
            ->toArray();
    }

    public static function select()
    {
        return  Buku::all();
    }

    public static function store($data)
    {
        return Buku::create($data);
    }

    public static function upd($id, $data)
    {
        return Buku::find($id)->update($data);
    }

    public static function del($id)
    {
        return Buku::destroy($id);
    }

    public static function selById($id)
    {
        return Buku::find($id);
    }

    public static function pinjam($id)
    {
        $dataBuku = Buku::selById($id);
        $stokLama = $dataBuku->stok;

        if ($stokLama > 0) {
            $stokBaru = $stokLama - 1;
            $dataBuku->update(['stok' => $stokBaru]);
            return true;
        } else {
            return false;
        }
    }

    public static function kembaliSingleBook($id)
    {
        $dataBuku = Buku::selById($id);
        $stokLama = $dataBuku->stok;

        $stokBaru = $stokLama + 1;
        $dataBuku->update(['stok' => $stokBaru]);
    }

    public static function kembali($peminjamanId)
    {
        $listPeminjaman = ListPeminjaman::where('peminjaman_id', $peminjamanId)->get();

        foreach ($listPeminjaman as $item) {
            $bukuId = $item->buku_id;
            Buku::kembaliSingleBook($bukuId);
        }
    }
}
