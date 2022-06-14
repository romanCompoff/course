<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LCourse;


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
                'user_id' => 'required|integer',
                'passp_number' => 'required|max:10',
                'passp_city' => 'required|max:20',
                'passp_adress' => 'required|max:255',
                'passp_adrss_mfc' => 'required|max:255',
                'passp_date' => 'required|date',
            ]);
            $st = new Student;
            $grpId = $st->getGroup($request->course_id);
            $request->group_id = $grpId;
            $v = Validator::make(['group_id' => $grpId->group_id], ['group_id' => 'required|integer']);
            $gId = $v->validated()['group_id'];
            $groupCount = $st->groupCount($gId);
            if($groupCount >= 9){
                return redirect()->back()->withErrors('Группа заполнена');
            }
            $isStudent = $st->isStudent($gId, $request->user_id);
            if($isStudent){
                return redirect()->back()->withErrors('Вы купили этот курс ранее');
            }
            $st->addStudent($request, $gId);
                return redirect()->back()->withSuccess('Курс добавлен');

        } catch(  Throwable  $e ){
            dump($e);

        }
    }


}
