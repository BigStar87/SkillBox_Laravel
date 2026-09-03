<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showFormBook()
    {
        return view('form_books');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'unique:books'],
            'author' => ['required', 'min:5'],
            'genre' => ['required'],
            'story' => ['required'],
        ]);

        $book = new Book($request->all());
        $book->save();

        return response()->json('Book was successifully validated and saved');
    }
}
