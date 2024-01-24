<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerbit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function store($data)
    {
        return Penerbit::create($data);
    }

    public static function select()
    {
        return Penerbit::all();
    }

    public static function upd($id, $data)
    {
        return Penerbit::find($id)->update($data);
    }

    public static function del($id)
    {
        return Penerbit::destroy($id);
    }
}
