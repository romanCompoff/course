<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($notice = '')
    {
        $users = User::leftJoin('teachers', "teachers.users_id", "=", 'users.id')->
        select('*', 'users.id as id', 'teachers.id as tId')->get();
        foreach ($users as $key => $value) {
            $users[$key]['isTeacher'] = $value->hasRole('teacher');
        }
        return view('teacher.list', ['users' => $users, 'notice'=> $notice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        $newTeacher = User::find($request);
        $teacher = new Teacher;
        $result = $teacher->create($newTeacher);


        return $this->index($result);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($request, $notice='')
    {
        $teacher = new Teacher;
        $teacherData = $teacher->getData($request);
        $specData = $teacher->getSpecialisation($request);

        // dd($teacherData);

        return view('teacher.form', ['user'=>$teacherData, 'notice'=>$notice, 'spec'=>$specData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher = new Teacher;
        $result = $teacher->update($request);
        // dd($result);

        return $this->index( $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
