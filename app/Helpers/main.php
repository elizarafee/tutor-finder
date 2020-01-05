<?php 

function dev_name() {
        echo "Eliza Ahmed";
    }


    function years_of_study($class_id = false) {
        $classes = [
            1 => 'Play Group',
            2 => 'Class 1',
            3 => 'Class 2',
            4 => 'Class 3',
            5 => 'Class 4',
            6 => 'Class 5',
            7 => 'Class 6',
            8 => 'Class 7',
            9 => 'Class 8',
            10 => 'Class 9',
            11 => 'Class 10',
            12 => 'HSC Year 1',
            13 => 'HSC Year 2',
        ];

        if($class_id) {
            return (isset($classes[$class_id]))? $classes[$class_id] : 'Not found';
        }

        return $classes;
    }


    function get_locations($location_id = false) {
        if($location_id) {
            $location = \App\Area::find($location_id);
            return ($location)? $location->name : 'Not found';
        }
        return \App\Area::orderBy('name', 'asc')->get()->toArray();
    }


    function tution_subjects($subject_id = false) {
        if($subject_id) {
            $subject = \App\Subject::find($subject_id);
            return ($subject)? $subject->name : 'Not found';
        }
        return \App\Area::orderBy('name', 'asc')->get()->toArray();
    }



?>
