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
        $crs = new Lcourse;
        $courses = $crs->getCourses();

        // dd(Auth()->user()->name);

        return view('courses.list', ['courses'=>$courses]) ;
    }

    public function homePage()
    {
        $lc = new LCourse;
        $cathegoryes = $lc->getCathegoryes();
        $teachers = $lc->getTeachers();

        return view('courses.main', ['cathegoryes'=>$cathegoryes, 'teachers'=>$teachers]);
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
        $cathegoryes = $crs->getCathegoryes();
        $teacher['id'] = $crs->getTeacherByUserId( Auth()->user()->id );
        $teacher['id'] = $teacher['id'][0]->id;
        $teacher['name'] = Auth()->user()->name ;

        return view('courses.form', [
            'shedules'=>$shedules,
            'teacher' => $teacher,
            'notice'=>'',
            'lvl'=>$lvl,
            'cathegory'=>$cathegoryes
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
        $crs = new LCourse;
        if(!isset($request->group) || !is_string($request->group)){
            return redirect()->back()->withErrors('Неправильное значение группы');
        }
        $groupId = +$crs->addGroup($request->group);
        $groupId = ( $groupId != 0 && is_int($groupId) ) ? ['group_id'=>$groupId] : false;
        if(!$groupId){
            return redirect()->back()->withErrors('Ошибка добавления группы');
        }
        $request->validate([
            'description'=>'string|required|max:255',
            'img'=>'required',
            'name'=>'string|required|max:255',
            'lvl_id'=>'integer|required',
            'teacher_id'=>'integer|required',
            'shedule_id'=>'integer|required'
        ]);
        $data = array_merge($request->all(), $groupId);
        $id = +$crs->store($data);
        if(!isset($id) || !is_int($id)){
            return redirect()->back()->withErrors('При добавлениие курса вернулся неожиданный результат. Изображение не добавлено!');
        }
        $name = $request->img->getClientOriginalName();
        $res = $request->img->move(Storage::path('../../public/img-courses/') . $id , $name);

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


    public function oneCourse(Request $request)
    {
        $cs = new LCourse;
        $data = $cs->getOneCathegory($request['id']);
        $courses = $cs->getCourses();


        return view('courses.one', ['cathegory'=>$data, 'courses'=>$courses]);
    }

    public function tests()
    {
        $model = new LCourse;
        $cathegoryes = $model->getCathegoryes();
        return view('courses.tests', ['cathegoryes' => $cathegoryes]);
    }

    public function courses()
    {
        $model = new LCourse;
        $cathegoryes = $model->getCathegoryes();
        return view('courses.coursesAll', ['cathegoryes'=>$cathegoryes]);

    }

    public function courseInCathegory(Request $request)
    {
        $model = new LCourse;
        $courses = $model->getCoursesOfCathegory($request->id);

        return view('courses.coursesAll', ['courses'=>$courses]);
    }

}
