<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'book_name', 'author', 'quantity'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'book_id');
    }
}
