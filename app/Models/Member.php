<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Member extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function select()
    {
        return Member::all();
    }

    public static function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        return Member::create($data);
    }

    public static function upd($id, $data)
    {
        return Member::find($id)->update($data);
    }

    public static function del($id)
    {
        return Member::destroy($id);
    }
}
