<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});

$app->get('/teachers','TeacherController@index');
$app->post('/teachers','TeacherController@store');
$app->get('/teachers/{teachers}','TeacherController@show');
$app->put('/teachers{teachers}','TeacherController@update');
$app->patch('/teachers{teachers}','TeacherController@update');
$app->delete('/teachers{teachers}','TeacherController@destroy');

$app->get('/students','StudentsController@index');
$app->post('/students','StudentsController@store');
$app->get('/students/{students}','StudentsController@show');
$app->put('/students{students}','StudentsController@update');
$app->patch('/students{students}','StudentsController@update');
$app->delete('/students{students}','StudentsController@destroy');

$app->get('/courses','CourseController@index');
$app->get('/courses/{courses}','CourseController@show');

$app->get('/teachers/{teachers}/courses','TeacherCourseController@index');
$app->post('/teachers/{teachers}/courses','TeacherCourseController@store');
$app->put('/teachers{teachers}/courses/{courses}','TeacherCourseController@update');
$app->patch('/teachers{teachers}/courses/{courses}','TeacherCourseController@update');
$app->delete('/teachers{teachers}/courses/{courses}','TeacherCourseController@destroy');

$app->get('/courses/{courses}/students','CourseStudentController@index');
$app->post('/courses/{courses}/students/{students}','CourseStudentController@store');
$app->delete('/courses/{courses}/students/{students}','CourseStudentController@destroy');