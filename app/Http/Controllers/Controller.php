<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function uploadPhoto($file, $path = "uploads")
    {
        $photoName = md5(time() . $file->getFilename()) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($path, $photoName, 'public');
    }
    public function deletePhoto($path)
    {
        $fullpath = storage_path('app/public/' . $path);
        // info('deleting' . $fullpath);
        if (file_exists($fullpath)) {
            unlink($fullpath);
        }

    }
}
