<?php

namespace App\Http\Controllers\Moodle;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class MoodleController{

    public function showUsers()
    {
        $response = Http::get('http://moodle/webservice/rest/server.php', [
            'wstoken' => '7b6017fcac2bda1cbcfcedf7bb5f52c5',
            'wsfunction' => 'local_wstemplate_get_users',
            'moodlewsrestformat' => 'json',
        ]);
        return View::make('users', array('users' => $response->json()));
    }
    public function showCourses()
    {
        $response = Http::get('http://moodle/webservice/rest/server.php', [
            'wstoken' => '7b6017fcac2bda1cbcfcedf7bb5f52c5',
            'wsfunction' => 'local_wstemplate_get_courses',
            'moodlewsrestformat' => 'json',
        ]);
        return View::make('courses', array('courses' => $response->json()));
    }
    public function showEnrolusers()
    {
        $response = Http::get('http://moodle/webservice/rest/server.php', [
            'wstoken' => '7b6017fcac2bda1cbcfcedf7bb5f52c5',
            'wsfunction' => 'local_wstemplate_get_enrol_users_and_grade',
            'moodlewsrestformat' => 'json',
        ]);

        return View::make('enrolusers', array('enroleusers' => $response->json()));
    }

}
