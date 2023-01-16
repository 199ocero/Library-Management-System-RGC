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

    // use WithPagination to use paginate() in render() function
    use WithPagination;

    // use bootstrap as pagination theme
    protected $paginationTheme = 'bootstrap';

    // declare variables
    public $stocks, $books, $borrowers, $book_name, $borrower_name, $date_borrowed, $amount, $unreturn_amount;

    // listener events in livewire components
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    /*
        mount data to books and borrowers variable
        so we can use this variable to show in select dropdown
    */
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

    // create a rule to validate the fields
    protected $rules = [
        'book_name' => 'required',
        'borrower_name' => 'required',
        'date_borrowed' => 'required',
        'amount' => 'required|integer|numeric|min:1',
    ];

    // function to store inventory
    public function store()
    {
        // validate data
        $this->validate();

        //check if stocks is equal to 0
        if ($this->stocks == 0) {
            // we will show a validation error message
            $this->addError('stocks', 'Book out of stock.');
        }
        /*
            check if the stocks is lesser than the inputted amount
            so we can know that the inputted amount is more than
            the available stocks
        */ else if ($this->stocks < $this->amount) {
            // we will show a validation error message
            $this->addError('stocks', 'You entered more than the available stock.');
        }
        /*
            else if the amount inputted is within the stocks
            availabillity then we will save the data
        */ else {

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

    //function to get the available stocks
    public function getQuantity($id)
    {
        // we get first the book quantity from books table
        $amount = Book::find($id);

        /* 
            and check first if there is a record in inventory
            and if there is a record we will get the amount
            column to get the sum of all amount/quantity borrowed
            and subtract it to the original quantity
        */
        $borrowed = Inventory::where('book_id', $id)->sum('amount');

        // subtract the original quantity to total borrowed book
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
