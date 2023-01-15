<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Models\Borrower;
use App\Models\Inventory;
use Livewire\WithPagination;

class ShowBorrowers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $books, $borrowers, $book_id, $borrower_id, $borrower_name, $book_name, $date_borrowed, $date_returned, $amount;

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->borrowers = Borrower::latest()->get();
    }

    // function to edit and show the specific borrower
    public function edit(Inventory $borrower)
    {
        $this->borrower_id = $borrower->id;
        $this->borrower_name = $borrower->borrower_id;
        $this->book_name = $borrower->book_id;
        $this->date_borrowed = $borrower->date_borrowed;
        $this->date_returned = $borrower->date_returned;
        $this->amount = $borrower->amount;
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['book_name', 'borrower_name', 'date_borrowed', 'date_returned', 'amount']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    public function render()
    {
        $inventories = Inventory::with('borrowers:id,id,full_name')
            ->with('books:id,book_name')
            ->where('book_id', $this->book_id)
            ->latest()
            ->paginate(5);

        return view('livewire.inventories.show-borrowers', [
            'inventories' => $inventories
        ]);
    }
}
