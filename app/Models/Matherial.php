<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Matherial extends Model
{
    use HasFactory;
    protected $table = 'materials';

    public function create()
    {
        return DB::table('l_courses')->select('id', 'name')->get();
    }

    public function store($param)
    {
        unset($param['_token']);
        $param['picture'] = $param['picture']->getClientOriginalName();
        return DB::table($this->table)->insertGetId($param);
    }

    public function getMaterials()
    {
        return DB::table($this->table)->get();
    }
}
