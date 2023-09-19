<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageVideosController extends Controller
{
    public function __invoke()
    {
        return view('pages.course-videos');
    }
}
