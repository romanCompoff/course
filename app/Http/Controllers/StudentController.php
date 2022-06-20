<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LCourse;
use App\Models\UserCourses;


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
            return $this->studyBuy($request->course_id);

        } catch(  Throwable  $e ){
            dump($e);

        }
    }
//вывод одного курса
    public function oneCourse( Request $request)
    {
        $model = new Student;
        $materials = $model->getMaterials($request->id);
        $student = $model->getStudent(auth()->user()->id, $request->id);
        if(!$student){
            return redirect()->back()->withSuccess('Нет доступа к курсу');
        }
        return view('study.onecourse', [
            'materials'=>$materials,
            'student'=>$student
        ]);
    }
    //вывод одного материала
    public function oneMaterial( Request $request)
    {
        $model = new Student;
        $materials = $model->getMaterial($request->id);
        $student = $model->getStudent(auth()->user()->id, $request->course_id);
        if(!$student){
            return redirect()->back()->withSuccess('Нет доступа к курсу');
        }
        return view('study.onematerial', [
            'materials'=>$materials,
            'student'=>$student
        ]);
    }

    public function passedMaterial(Request $request)
    {
        $model = new Student;

        $passeed =  $model->getpassedMaterial($request->course_id,  auth()->user()->id);
        if($passeed->passedMaterials >= $request->id){
            return redirect()->route('home')->withSuccess('Материал пройден повторно');
        }
        $res = $model->passedMaterial($request->course_id, $request->id, auth()->user()->id);
        if(!$res){
            // redirect()->back()->withErrors('Ошибка добавления');
        }
        return redirect()->route('home')->withSuccess('Материал пройден. Домашнее задание доступно');
    }
    // получаем параметры курса и времени для покупки и рссчитываем стоимость. Добавляем заказ и Отправляем на оплату
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
        $arr = [
            'user_id'=>auth()->user()->id,
            'course_id'=>$request->course,
            'timeOfUsing'=>date('Y/m/d', $month)
        ];
        $model = new UserCourses;
        $res = $model->isPay($arr);


        if(is_object($res) && isset($res->pay)){
            return redirect()->route('study.notice')->withErrors('Курс уже куплен');
        }
        if(!isset($res)){
            $model->addPay($arr);
        }
        if(is_object($res) && !isset($res->pay)){
            $model->updatePay($arr);
        }

        return view('study.pay', [
            'time'=>date('Y-m-d', $month),
            'money'=>$money,
            'course_id'=>$request->course

        ]);
    }
    // получаем информацию о оплате, добавляем в группу и даем доступ к курсу и присваиваем роль студента, если все условия соблюдены
    public function makeStudent(Request $request)
    {
        $model = new UserCourses;
        $arr = [
            'user_id'=>auth()->user()->id,
            'course_id'=>$request->course_id,
            'timeOfUsing'=>$request->time
        ];
        if(!$model->isValidPay($arr['user_id'])){
            return redirect()->route('study.notice')->withErrors('Заказ не добавлен. Вернитесь на страницу выбора курса и добавьте курс и срок обучения');

        }
        $st = new Student;
        $grpId = +$st->getGroup($arr['course_id'])->group_id;

        if(!is_int($grpId) || $grpId == 0){
            return redirect()->route('study.notice')->withErrors('Не найдена группа');
        }
        $groupCount = $st->groupCount($grpId);

        if($groupCount >= 9){
            return redirect()->route('study.notice')->withErrors('Группа заполнена');
        }
        $isStudent = $st->isStudent($grpId, $arr['user_id']);
        if($isStudent){
            return redirect()->route('study.notice')->withErrors('Вы купили этот курс ранее');
        }
        if(!auth()->user()->hasRole('student')){
            auth()->user()->assignRole('student');

        }
        $res = $model->payCourse($arr);
        if(!$res){
            return redirect()->route('study.notice')->withErrors('Ошибка оплаты');
        }
        $st->addStudent($grpId, $arr['user_id']);

        return redirect()->route('study.notice')->withSuccess('курс оплачен и добавлен');
    }

    public function homeWork(Request $request)
    {
        $model = new Student;
        $material = $model->getMaterial($request->id);
        // dd($material);
        return view('study.homework', ['material'=>$material]);
    }



    public function notice()
    {
        return view('study.notice');
    }


}
