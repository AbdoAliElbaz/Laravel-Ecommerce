<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;

function get_language() {
    return Language::active()->selection()->get() ;
}

function def_lang() {
   return Config::get('app.locale');
}


function uploadImage($folder, $image)
{
    $image->store( 'public' ,  $folder);
    $filename = $image->hashName();
    $path =  $folder  . $filename;
    return $path;
}


// function showName() {
//     return "Abdo Ali";
// }
