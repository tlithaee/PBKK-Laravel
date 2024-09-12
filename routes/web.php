<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog Page', 'posts' => [
        [
            'id' => 1,
            'title' => 'Judul Artikel 1',
            'author' => 'Lita',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
        ],
        [
            'id' => 2,
            'title' => 'Judul Artikel 2',
            'author' => 'Lita',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
        ]
    ]]);
});

Route::get('/posts/{id}', function($id){
    $posts = [
        [
            'id' => 1,
            'title' => 'Judul Artikel 1',
            'author' => 'Lita',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
        ],
        [
            'id' => 2,
            'title' => 'Judul Artikel 2',
            'author' => 'Lita',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
        ]
    ];
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Page', 'nama' => 'Lita']);
});