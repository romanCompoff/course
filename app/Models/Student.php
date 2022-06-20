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

    public function addStudent( $gId, $uId)
   {
        $res = DB::table('usersBig')->insert(['groupe-id'=>$gId, 'user-id'=>$uId ]);
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

   public function getStudent($uId, $cId)
   {
       return DB::table('user_courses')
       ->where('user_id', $uId)
       ->where('course_id', $cId)
       ->where('timeOfUsing', '>', NOW())
       ->first();
   }

   public function passedMaterial($cId, $mId, $uId)
   {
    return DB::table('user_courses')
    ->where('user_id', $uId)
    ->where('course_id', $cId)
    ->update(['passedMaterials'=> $mId]);
   }

   public function getPassedMaterial($cId, $uId)
   {
       return DB::table('user_courses')
       ->where('user_id', $uId)
       ->where('course_id', $cId)
       ->first();
   }

   public function getMaterial($id)
   {
       return DB::table('materials')->where('id', $id)->first();
   }

   public function getRating($cId, $uId)
   {
    return DB::table('user_courses')
    ->where('user_id', $uId)
    ->where('course_id', $cId)
    ->first();
   }

   public function addRating($cId, $uId, $rating, $hw)
   {
    return DB::table('user_courses')
    ->where('user_id', $uId)
    ->where('course_id', $cId)
    ->update(['rating'=>$rating, 'homeWork'=>$hw]);
   }

}
