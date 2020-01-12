<?php

    function developer($key = '') {
        
        $info = [
            'name' => 'Eliza Ahmed',
            'email' => 'elizarafee@gmail.com',
        ];

        return (isset($info[$key]))? $info[$key] : '';
    }

    function has_connection($user_id) {
        $received = \App\Connection::where('requested_by', $user_id)
        ->where('request_to', Auth::user()->id)
        ->first();

        if ($received) {
            if ($received->accepted_at == '') {
                return ['connected' => false, 'request' => 'received', 'time' => $received->created_at];
            } else {
                return ['connected' => true, 'request' => 'received', 'time' => $received->created_at];
            }
        }

        $sent = \App\Connection::where('request_to', $user_id)
        ->where('requested_by', Auth::user()->id)
        ->first();

        if ($sent) {
            if ($sent->accepted_at == '') {
                return ['connected' => false, 'request' => 'sent', 'time' => $sent->created_at];
            } else {
                return ['connected' => true, 'request' => 'sent', 'time' => $sent->created_at];
            }
        }

        return ['connected' => false, 'request' => false];
    }


    function levels_of_study($level  = false) {
        $levels = [
            1 => 'School Student',
            2 => 'SSC',
            3 => 'HSC',
            4 => 'Other Training',
            5 => 'Diploma',
            6 => 'Bachelor',
            7 => 'Master',
            8 => 'Ph.D.',
        ];

        if ($level) {
            return (isset($levels[$level]))? $levels[$level] : 'Not found';
        }

        return $levels;
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

        if ($class_id) {
            return (isset($classes[$class_id]))? $classes[$class_id] : 'Not found';
        }

        return $classes;
    }


    function locations($location_id = false) {
        if ($location_id) {
            $location = \App\Area::find($location_id);
            return ($location)? $location->name : 'Not found';
        }
        return \App\Area::orderBy('name', 'asc')->get()->toArray();
    }


    function tution_subjects($subject_id = false) {
        if ($subject_id) {
            $subject = \App\Subject::find($subject_id);
            return ($subject)? $subject->name : 'Not found';
        }
        return \App\Subject::orderBy('name', 'asc')->get()->toArray();
    }


    function no_of_awaiting_response() {
        return \App\User::whereNotNull('completed_at')
        ->whereNull('rejected_at')
        ->whereNull('approved_at')
        ->where('reviewed', 0)
        ->count();
    }

    function no_of_connection_requests() {
        return \App\Connection::whereNull('accepted_at')
        ->where('request_to', Auth::id())
        ->count();
    }
