<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'student_id', 'full_name', 'address', 'contact_number'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'borrower_id');
    }
}
