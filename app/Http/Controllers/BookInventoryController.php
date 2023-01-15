<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookInventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function showBorrower($book_id)
    {
        return view('inventory.borrower', [
            'book_id' => $book_id
        ]);
    }
}
