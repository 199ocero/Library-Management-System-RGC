<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookBorrowerController extends Controller
{
    public function __invoke()
    {
        return view('books.index');
    }
}
