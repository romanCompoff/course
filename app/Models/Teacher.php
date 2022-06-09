<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    public function index()
    {
        dd($table->find(1));
    }

    public function create($newTeacher)
    {
        $newTeacher->assignRole('student');
        $result = $newTeacher->assignRole('teacher');
        $result = DB::table($this->table)->insert(['users_id'=> $newTeacher['id'], 'specialisation_id'=>'1']);

        return $result;
    }

    public function edit($teacher_id)
    {

    }

    // public  function getUsers()
    // {
    //     $result = DB::table('users')
    //     ->leftJoin($this->table, 'users.id', '=', "$this->table.users_id")
    //     ->select('*', 'id as')
    //     ->get();
    //     return $result;
    // }
    

    public function getData($teacher_id)
    {
        $result = DB::table($this->table)
        ->join('users', "$this->table.users_id", "=", 'users.id')
        ->select('*')
        ->where("$this->table.id", '=', $teacher_id)
        ->get();
        return $result;
    }

    public function update($request = [], $array = [])
    {
        $result = DB::table($this->table)
        ->where('id', '=', $request['tId'])
        ->update(['specialisation_id'=>$request['specialisation_id']] );
        $result = DB::table('users')
        ->where('id', '=', $request['uId'])
        ->update(['name'=>$request['name'], 'email'=>$request['email'], ] );

        return $result;

    }

    public function getSpecialisation()
    {
        return DB::table('specialisation')->select('id', 'name')->get();
    }
}
