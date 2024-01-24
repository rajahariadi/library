<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rak extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function store($data)
    {
        return Rak::create($data);
    }

    public static function select()
    {
        return Rak::all();
    }

    public static function upd($id, $data)
    {
        return Rak::find($id)->update($data);
    }

    public static function del($id)
    {
        return Rak::destroy($id);
    }
}
