<?php

namespace App\Http\Controllers\Trait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait FileUploadTrait
{
    public function saveFile(Request $r, string $type, string $filename = null, string $fileKey = 'image')
    {
        $upload_path = storage_path("app/public/$type");
        $thumb_path = storage_path("app/public/$type/thumb");
        
        if (! file_exists($upload_path)) mkdir($upload_path, 0777);
        if (! file_exists($thumb_path)) mkdir($thumb_path, 0777);

        if ($r->hasFile($fileKey)) {
            $imgFile = $r->file($fileKey);

            $id = $filename ?? time();
            $filename = Str::slug($id) . '.' . $imgFile->extension();
            if (file_exists("$upload_path/$filename")) $filename = $this->getUniqueName($filename, $upload_path);
            
            $manager = New ImageManager(Driver::class);

            $image = $manager->read($imgFile);
            $image->save("$upload_path/$filename");

            $thumb = $manager->read($imgFile);
            $thumb->scale(height: 60);
            $thumb->save("$thumb_path/$filename");
            
            return $filename;
        }
        
        return null;
    }

    public function getUniqueName($name, $path)
    {
        $inc = 1;
        $newName = null;
        $break = true;

        do {
            $split = explode('.', $name);
            
            $newFileName = $split[0] . '-' . $inc . '.' . end($split);
            $filePath = $path . '/' . $newFileName;
            
            $break = file_exists($filePath) ? true : false;
            if (!$break) $newName = $newFileName;
            $inc++;
        } while ($break);

        return $newName;
    }
}