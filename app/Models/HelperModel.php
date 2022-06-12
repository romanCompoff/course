<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperModel extends Model
{
    use HasFactory;

    public function removeToken($request)
    {
        $param = $request->toArray();
        unset($param['_token']);

        return $param;
    }
}
