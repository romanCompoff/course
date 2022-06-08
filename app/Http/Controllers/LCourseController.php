<?php

namespace App\Http\Controllers;

use App\Models\LCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
// use App\Models\User;


class LCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Auth()->user()->name);
        return ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crs = new LCourse;
        $shedules = $crs->getShedules();
        $lvl = $crs->getLvl();
        $groups = $crs->getGroups();
        $teacher = ['id' => Auth()->user()->id, 'name' => Auth()->user()->name] ;

        return view('courses.form', [
            'shedules'=>$shedules,
            'teacher' => $teacher,
            'notice'=>'',
            'groups'=>$groups,
            'lvl'=>$lvl
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crs = new Lcourse;
        // $result = $crs->store($request);

        $res = $request->img->move(Storage::path('../../public/img-courses/'), $request->name .
        '.'
        . explode('.', $request->img->getClientOriginalName())[1]);
        $result = $crs->store($request);

        return redirect()->back()->withSuccess('Добавлено');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LCourse  $lCourse
     * @return \Illuminate\Http\Response
     */
    public function show(LCourse $lCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LCourse  $lCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(LCourse $lCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LCourse  $lCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LCourse $lCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LCourse  $lCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(LCourse $lCourse)
    {
        //
    }
}
