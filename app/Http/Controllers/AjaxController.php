<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Area;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubjects()
    {
        return Subject::pluck('name');
    }

    public function getLocations()
    {
        return Area::pluck('name');
    }
}
