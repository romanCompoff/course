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

    public function getCathegoryes()
    {
        return DB::table('cathegoryes')->select('id', 'name', 'img')->get();
    }

    public function getTeacherByUserId($uId)
    {
        return DB::table('teachers')->select('id')->where('users_id', $uId)->get();
    }

    public function getTeachers()
    {
        return DB::table('teachers')
        ->join('users', 'teachers.users_id', '=', 'users.id')
        ->get();
    }

    public function store($request)
    {
        $param = $request->toArray();
        unset($param['_token']);
        $param['img'] = $param['img']->getClientOriginalName();
        DB::table($this->table)->insert($param);
        return DB::getPdo()->lastInsertId();
    }

    public function getCoursesOfCathegory($id)
    {
        return DB::table($this->table)->where('cathegory_id', '=', $id)->get();
    }

    public function getCourses()
    {
        return DB::table($this->table)->get();
    }

    public function getOneCourse(string $id)
    {
        return DB::table($this->table)->find($id);
    }

    public function getOneCathegory(string $id)
    {
        return DB::table('cathegoryes')->find($id);
    }
}
