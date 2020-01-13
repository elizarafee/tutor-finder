<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Area;

/**
 * Takes care of all ajax request in the applicaiton 
 */

class AjaxController extends Controller
{
    /**
     * @return array list of subjects 
     */
    public function getSubjects()
    {
        return Subject::pluck('name');
    }

    /**
     * @return array list of locations 
     */
    public function getLocations()
    {
        return Area::pluck('name');
    }
}
