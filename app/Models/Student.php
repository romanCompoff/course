<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\HelperModel;


class Student extends Model
{
    use HasFactory;

    public function getGroup($course_id)
    {
        try{
            return DB::table('l_courses')
            ->select('group_id')
            ->where('id', '=', $course_id)
            ->first();

        } catch( Throwable  $e ){
            return $e;
        }
    }

    public function isStudent($gId, $uId)
    {
        return DB::table('usersBig')
        ->where('groupe-id', '=', $gId)
        ->where('user-id', '=', $uId)
        ->exists();
    }

    public function addStudent($request, $gId)
   {
        $data = HelperModel::removeToken($request);
        $res = DB::table('usersBig')->insert(['groupe-id'=>$gId, 'user-id'=>$data['user_id'] ]);
        if(!$res){return false;}
        unset($data['course_id']);
        $res = DB::table('requisites')->insert($data);
        return $res;

   }


}
