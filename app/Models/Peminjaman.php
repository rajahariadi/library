<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends =
    [
        'status'
    ];

    public function bukus()
    {
        return $this->hasManyThrough(Buku::class, ListPeminjaman::class, 'peminjaman_id', 'id', 'id', 'buku_id');
    }

    public function listPeminjaman()
    {
        return $this->hasMany(ListPeminjaman::class, 'peminjaman_id');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function getStatusAttribute()
    {
        $tgl_kembali = $this->tgl_kembali;
        if (isset($tgl_kembali)) {
            return 'Sudah Dikembalikan';
        } else {
            $tgl_tenggat = $this->tgl_tenggat;
            $tgl_sekarang = Carbon::now()->toDateString();
            if ($tgl_sekarang <= $tgl_tenggat) {
                return 'Dipinjam';
            } else {
                return 'Terlambat';
            }
        }
    }

    public static function select()
    {
        return Peminjaman::all();
    }

    public static function store($data)
    {
        return Peminjaman::create($data);
    }

    public static function upd($id, $data)
    {
        return Peminjaman::find($id)->update($data);
    }

    public static function del($id)
    {
        return Peminjaman::destroy($id);
    }

    public static function pinjam($data)
    {
        return Buku::pinjam($data['buku_id']);
    }
}
