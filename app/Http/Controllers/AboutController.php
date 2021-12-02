<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function home() {
        return view('home');
    }
    public function about() {
        return view('about');   
    }
    /*public function blog($id, $myAuthor = 'default author' ) {
        $posts = [
            1 => ['title' => '<a> learn laravel 8 </a>'],
            2 => ['title' => 'learn Angular'],
        ];
    
    
        return view('posts.show', [
            'data' => $posts[$id],
            'author' => $myAuthor,
        ]);
    }*/
}
