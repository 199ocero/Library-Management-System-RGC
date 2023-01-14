<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class Inventories extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $books;

    public function mount()
    {
        $this->books = Book::latest()->get();
    }
    public function render()
    {
        $borrowed_books = Inventory::latest()->paginate(5);
        return view('livewire.inventories.inventories', ['borrowed_books' => $borrowed_books]);
    }
}
