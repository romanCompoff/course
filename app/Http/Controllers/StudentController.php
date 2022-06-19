<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LCourse;


class StudentController extends Controller
{
    protected $price = 10000;
    public function passport(Request $request)
    {
        $user_id = auth()->user()->id;
        $model = new Student;
        $isReq = $model->getRequisites($user_id);
        if($isReq){
            return $this->studyBuy($request->id);
            
        }
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
            $st->addRequisites($request);
            $this->studyBuy($request->course_id);
                return ;

        } catch(  Throwable  $e ){
            dump($e);

        }
    }

    public function oneCourse( Request $request)
    {
        $model = new Student;
        $materials = $model->getMaterials($request->id);
        
        return view('study.onecourse', ['materials'=>$materials]);
    }

    public function studyBuy($id)
    {
        $model = new LCourse;
        $course = $model->getOneCourse($id);
    
        return view('study.buy', ['course'=>$course]);
    }

    public function studyPay(Request $request)
    {
        $request->validate([
            'time'=>'required|integer'
        ]);
        $money = $this->price * $request->time;
        $month = time() + ($request->time * 60 * 60 * 24 * 30);
        dd(date('Y-m-d', $month));
        $grpId = +$st->getGroup($request->course_id);
        if(!is_int($grpId) || $grpId == 0){
            return redirect()->back()->withErrors('Не найдена группа');
        }
        $groupCount = $st->groupCount($grpId);
        if($groupCount >= 9){
            return redirect()->back()->withErrors('Группа заполнена');
        }
        $isStudent = $st->isStudent($gId, $request->user_id);
        if($isStudent){
            return redirect()->back()->withErrors('Вы купили этот курс ранее');
        }
    }


}
