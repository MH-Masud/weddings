<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($image,$path,$mediumW,$mediumH)
    {
        $filePath = public_path($path);
        if(!File::exists($filePath)){
            File::makeDirectory($filePath, 0777, true, true);
        }
        $destinationPath = public_path($path);

        $thumb_img = date('Y-m-d').'_'.rand().'_thumb'.'.webp' ;
        Image::make($image->getRealPath())->encode('webp', 90)->resize($mediumW, $mediumH, function ($constraint) {
            // $constraint->aspectRatio();
        })->save($destinationPath.'/'.$thumb_img);

        $main_img = date('Y-m-d').'_'.rand().'_main'.'.webp' ;
        $image->move($destinationPath, $main_img);

        $images[] = array(
            'image' => $main_img,
            'thumb' => $thumb_img,
        );
        return json_encode($images);
    }
}
