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

    public function store($param)
    {

        unset($param['_token']);
        unset($param['group']);
        $param['img'] = $param['img']->getClientOriginalName();
        DB::table($this->table)->insert($param);

        return DB::getPdo()->lastInsertId();
    }

    public function addGroup(string $name)
    {
        DB::table('groups')->insert(['name'=>$name]);

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

    public function homeWorks($cId, $passedMaterials, $homeWork)
    {
        $homeWork = !isset($homeWork) ? 0 : $homeWork;
        if(!$passedMaterials){$passedMaterials = -1;}
        return DB::table('materials')
        ->where('course_id', $cId)
        ->whereBetween('id', [$homeWork, $passedMaterials])
        ->where('id', '<=', $passedMaterials)
        ->where('id', '!=', $homeWork)
        ->limit(1)
        ->get();

    }

    public function coursesOfUser($id)
    {
        return DB::table('usersbig')
        ->join('user_courses', 'user_courses.user_id', 'usersBig.user-id')
        ->where('timeOfUsing', '>', NOW())
        ->where('user-id', '=', $id)
        ->join('l_courses', 'l_courses.group_id', 'usersbig.groupe-id')
        ->get();
    }

    public function mainRat()
    {
        return DB::table('user_courses')
        ->join('users', 'users.id', 'user_courses.user_id')
        ->orderBy('rating', 'desc')
        ->where('rating', '>', 0)
        ->get();

    }
}
