<?php

namespace App\Traits;

Trait  ImageTrait
{
     function saveImage($photo,$folder){
        //save photo in folder
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        return "/".$path."/".$file_name;
    }


}
