<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/courses', function () {
    return '<h1>Available Courses</h1>';
})->name('courses');

Route::get('/home', function () {
    return '<a href="' . route('courses') . '">Courses</a>';
});


Route::get('/courses/category/{category?}', function ($category = null) {
    return $category ? "Category: {$category}" : 'All categories';
});

Route::get('/courses/{id}/{title}', function ($id, $title) {
    return "Course {$id}: {$title}";
})->whereNumber('id')->whereAlpha('title');

Route::get('/courses/{id}', function ($id) {
    return "Course {$id}";
})->whereNumber('id');

// Task 3
Route::get('/courses/search', function (Request $request) {
    return response()->json([
        'keyword' => $request->query('keyword'),
        'level' => $request->input('level', 'Beginner'),
        'hasKeyword' => $request->has('keyword'),
    ]);
});


Route::get('/courses/featured', function () {
    return response()
        ->json(['message' => 'Featured courses'], 200)
        ->header('X-Course-Source', 'Laravel')
        ->cookie('last_visited', 'featured');
});


Route::redirect('/catalog', '/courses');
