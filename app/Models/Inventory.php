<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'book_id', 'borrower_id', 'amount', 'date_borrowed', 'date_returned'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'id', 'book_id');
    }
}
