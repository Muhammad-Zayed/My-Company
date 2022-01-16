<?php

use \Illuminate\Support\Facades\Storage;

function get_image($filename)
{
    return '/storage/' . $filename ;
}

function uploader($request, $image_name)
{
    return Storage::disk('public')->putFile('images', $request->file($image_name));
}
