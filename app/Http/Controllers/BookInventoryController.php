<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookInventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function showBorrower()
    {
        return view('inventory.borrower');
    }
}
