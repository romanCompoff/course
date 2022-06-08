<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class LCourse extends Model
{
    use HasFactory;

    protected $table = 'l_courses';

    public function getShedules()
    {
        return DB::table('shedules')->select('id', 'name')->get();
    }

    public function getLvl()
    {
        return DB::table('lvl_lang')->select('id', 'description')->get();
    }

    public function getGroups()
    {
        return DB::table('groups')->select('id', 'name')->get();
    }

    public function store($request)
    {
        $param = $request->toArray();
        unset($param['_token']);
        unset($param['img']);
        return DB::table($this->table)->insert($param);
    }
}
