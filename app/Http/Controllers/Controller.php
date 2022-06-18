<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function removeFileAndDir($path)
    {

        if (is_dir($path) === true)
        {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $f)
            {
                $this->removeFileAndDir(realpath($path) . '/' . $f);
            }
            return rmdir($path);
        }
            else if (is_file($path) === true)
        {
            return unlink($path);
        }

        return false;
    }

}
