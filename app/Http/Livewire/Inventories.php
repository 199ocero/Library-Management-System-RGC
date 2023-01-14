<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class Inventories extends Component
{
    public function render()
    {
        $borrowed_books = Inventory::latest()->paginate(5);
        return view('livewire.inventories.inventories', ['borrowed_books' => $borrowed_books]);
    }
}
