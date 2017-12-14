<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function showAll() {
        $images = Image::all();
        return View('instagram/index', ['images' => $images]);
    }
}
