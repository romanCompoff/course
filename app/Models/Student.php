<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function addStudent($request)
   {
       unset($request->_token);
    dd($request);
   }


}
