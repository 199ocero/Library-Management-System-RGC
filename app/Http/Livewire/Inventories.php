<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Borrower;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class Inventories extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $books, $borrowers, $book_name, $borrower_name, $date_borrowed, $date_returned;

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->borrowers = Borrower::latest()->get();
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['book_name', 'date_borrowed', 'date_returned']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    public function render()
    {
        $borrowed_books = Inventory::latest()->paginate(5);
        return view('livewire.inventories.inventories', [
            'borrowed_books' => $borrowed_books,
        ]);
    }
}
