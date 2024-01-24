<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function store($data)
    {
        return Kategori::create($data);
    }

    public static function select()
    {
        return Kategori::all();
    }

    public static function upd($id, $data)
    {
        return Kategori::find($id)->update($data);
    }

    public static function del($id)
    {
        return Kategori::destroy($id);
    }
}
