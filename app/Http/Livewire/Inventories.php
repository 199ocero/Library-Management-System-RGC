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

    public $books, $borrowers, $book_name, $borrower_name, $date_borrowed, $amount;

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->borrowers = Borrower::latest()->get();
    }

    // create a rule to validate the input fields
    protected $rules = [
        'book_name' => 'required',
        'borrower_name' => 'required',
        'date_borrowed' => 'required',
        'amount' => 'required|integer',
    ];

    // function to store borrower
    public function store()
    {
        $this->validate();

        // save borrower if validation is success
        Inventory::create([
            'book_id' => $this->book_name,
            'borrower_id' => $this->borrower_name,
            'date_borrowed' => $this->date_borrowed,
            'amount' => $this->amount,
        ]);

        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Inventory created successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['book_name', 'borrower_name', 'date_borrowed', 'amount']);

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
