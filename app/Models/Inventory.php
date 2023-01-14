<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'book_id', 'borrower_id', 'amount', 'date_borrowed', 'date_returned'
    ];
}
