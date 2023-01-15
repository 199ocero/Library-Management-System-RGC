<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Models\Borrower;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Inventories extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $stocks, $books, $borrowers, $book_name, $borrower_name, $date_borrowed, $amount, $unreturn_amount;

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->borrowers = Borrower::latest()->get();
    }

    // declare variable for search filter
    public $search = '';

    // to reset the page to page 1
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // create a rule to validate the input fields
    protected $rules = [
        'book_name' => 'required',
        'borrower_name' => 'required',
        'date_borrowed' => 'required',
        'amount' => 'required|integer',
    ];

    // function to store inventory
    public function store()
    {
        $this->validate();

        if ($this->stocks <= 0) {
            $this->addError('stocks', 'Book out of stock');
        } else {
            // save inventory if validation is success
            Inventory::create([
                'book_id' => $this->book_name,
                'borrower_id' => $this->borrower_name,
                'date_borrowed' => $this->date_borrowed,
                'amount' => $this->amount,
                'unreturn_amount' => $this->amount,
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
    }

    public function getQuantity($id)
    {
        $amount = Book::find($id);
        $borrowed = Inventory::where('book_id', $id)->sum('amount');

        $this->stocks = $amount->quantity - $borrowed;
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['book_name', 'borrower_name', 'date_borrowed', 'amount', 'stocks']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    public function render()
    {
        $search = $this->search;
        $borrowed_books = Inventory::select('book_id', DB::raw('SUM(amount) as total_amount'))
            ->with('books:id,book_name,quantity')
            ->groupBy('book_id')
            ->whereHas('books', function ($query) use ($search) {
                $query->where('book_name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);
        return view('livewire.inventories.inventories', [
            'borrowed_books' => $borrowed_books,
        ]);
    }
}
