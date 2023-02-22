<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function saveFile($file,$namespace)
    {
        if($file){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = str_replace(' ', '', $filename).'_'.time().'.'.$extension;
            $filenameReturned = Storage::disk('public')->put($namespace, $file, 'public');
            return $filenameReturned;
        }
        return "";
    }
}
