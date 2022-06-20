<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserCourses extends Model
{
    use HasFactory;

    protected $table = 'user_courses';

    public function isPay($param)
    {
         return DB::table('user_courses')
         ->select('pay')
         ->where('user_id', $param['user_id'])
         ->where('course_id', $param['course_id'])
         ->first() ;
    }
//проверка, что имеется заказанный курс для оплаты
    public function isValidPay($id)
    {
        return DB::table($this->table)
        ->where('user_id', $id)
        ->where('pay', null)
        ->first();
    }
//Добавляем новый курс
    public function addPay($param)
    {
         return DB::table('user_courses')->insert($param);
    }
//если уже имеется неоплаченный заказ изменяем его курс  время
    public function updatePay($arr)
    {
        return DB::table('user_courses')
        ->where('user_id', $arr['user_id'])
        ->where('pay', null)
        ->update([
            'timeOfUsing'=>$arr['timeOfUsing'],
            'course_id'=>$arr['course_id']
        ]);
    }
//даем доступ к курсу
    public function payCourse($arr)
    {
        return DB::table($this->table)
        ->where('user_id', $arr['user_id'])
        ->update(['pay'=>true]);
    }
}
