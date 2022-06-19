<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\HelperModel;


class Student extends Model
{
    use HasFactory;

    protected $table = 'materials';

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

    public function groupCount($id)
    {
        return DB::table('usersBig')
        ->where('groupe-id', '=', $id)
        ->count();
    }

    public function addStudent($request, $gId)
   {
        $data = HelperModel::removeToken($request);
        $res = DB::table('usersBig')->insert(['groupe-id'=>$gId, 'user-id'=>$data['user_id'] ]);
        if(!$res){return false;}
        


   }

   public function addRequisites($request)
   {
        $data = HelperModel::removeToken($request);
        unset($data['course_id']);
        $res = DB::table('requisites')->insert($data);
        return $res;
   }

   public function getRequisites($id)
   {
       return DB::table('requisites')->where('user_id', $id)->first();
   }

   public function getMaterials($id)
   {
       return DB::table($this->table)->where('course_id', $id)->get();
   }


}
