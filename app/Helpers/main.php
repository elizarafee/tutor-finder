<?php 

function dev_name() {
        echo "Eliza Ahmed";
    }


    function years_of_study() {
        return [
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
    }


    function get_locations() {
        return \App\Area::orderBy('name', 'asc')->get()->toArray();
    }



?>
