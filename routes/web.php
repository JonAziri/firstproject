<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/courses', function () {
    return '<h1>Available Courses</h1>';
})->name('courses');

Route::get('/home', function () {
    $url = route('courses');
    return "<a href=\"$url\">View Courses</a>";
});

Route::get('/courses/{id}/{title}', function ($id, $title) {
    return 'Course ' . $id . ': ' . $title;
})->where([
    'id' => '[0-9]+',
    'title' => '[A-Za-z]+',
]);

Route::get('/courses/{id}', function ($id) {
    return 'Course ' . $id;
})->where('id', '[0-9]+');

Route::get('/courses/category/{category?}', function ($category = null) {
    if ($category === null) {
        return 'All categories';
    }

    return 'Category: ' . $category;
});

Route::get('/courses/search', function (Request $request) {
    $keyword = $request->query('keyword');
    $level = $request->input('level', 'Beginner');
    $hasKeyword = $request->has('keyword');

    return response()->json([
        'keyword' => $keyword,
        'level' => $level,
        'hasKeyword' => $hasKeyword,
    ]);
});

Route::get('/courses/featured', function () {
    return response()->json([
        'message' => 'Featured courses'
    ], 200)
        ->header('X-Course-Source', 'Laravel')
        ->cookie('last_visited', 'featured');
});

Route::redirect('/catalog', '/courses');
