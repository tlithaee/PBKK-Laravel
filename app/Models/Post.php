<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Post {
    public static function all() {
        return [
            [
                'id' => 1,
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Artikel 1',
                'author' => 'Lita',
                'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
            ],
            [
                'id' => 2,
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Artikel 2',
                'author' => 'Lita',
                'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque blanditiis ad atque, doloribus optio vel dolorem. Porro culpa suscipit veniam incidunt impedit repellat deserunt, quasi placeat excepturi iusto libero praesentium.'
            ]
        ];
    }

    public static function find($slug): array {
        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);
        
        if(! $post) {
            abort(404);
        }

        return $post;
    }
}