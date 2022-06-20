<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LCourse;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth()->user()->id;
        $v = Validator::make(['user_id' => $user_id], ['user_id' => 'required|integer']);
        $uId = $v->validated()['user_id'];
        $model = new LCourse;
        $usersCourses = $model->coursesOfUser($uId);

        $arr = [];
        foreach($usersCourses as $uc){
           $homeworks = $model->homeWorks($uc->id, $uc->passedMaterials, $uc->homeWork);
           array_push($arr, $homeworks->all());
        }
        $res = $model->mainRat();

        return view('home', ['usersCourses'=>$usersCourses, 'homeWorks'=>$arr, 'mainRating'=>$res]);
    }
}
