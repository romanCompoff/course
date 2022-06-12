<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function passport(Request $request)
    {
        $user_id = auth()->user()->id;
        return view('study.passport', ['user_id' => $user_id, 'course_id' => $request->id]);
    }

    public function checkAndAdd(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|integer'
            ]);
            $st = new Student;
            $grpId = $st->getGroup($request->course_id);
            $request->group_id = $grpId;
            $v = Validator::make(['group_id' => $grpId->group_id], ['group_id' => 'required|integer']);
            $gId = $v->validated()['group_id'];
            $isStudent = $st->isStudent($gId, $request->user_id);
            if($isStudent){
                return redirect()->back()->withErrors('Вы купили этот курс ранее');
            }
            $st->addStudent($request);

        } catch(  Throwable  $e ){
            dump($e);

        }



        $request->validate([
            'group_id'=>'required|min:2',
            'user_id' => 'required|min:2',
            // 'passp_number' => 'required'

        ]);


        dd($request->validate);
        // dd($result);

        return view('study.add-student');
    }
}
