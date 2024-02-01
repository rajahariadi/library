<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListPeminjaman extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public static function select()
    {
        return ListPeminjaman::all();
    }

    public static function store($data)
    {
        return ListPeminjaman::create($data);
    }

    public static function upd($id, $data)
    {
        return ListPeminjaman::find($id)->update($data);
    }

    public static function del($id)
    {
        return ListPeminjaman::where('peminjaman_id', $id)->delete();
    }
}
