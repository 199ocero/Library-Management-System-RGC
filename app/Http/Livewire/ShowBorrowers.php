<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Models\Borrower;
use App\Models\Inventory;
use Livewire\WithPagination;

class ShowBorrowers extends Component
{
    // use WithPagination to use paginate() in render() function
    use WithPagination;

    // use bootstrap as pagination theme
    protected $paginationTheme = 'bootstrap';

    // declare variables
    public $stocks, $books, $borrowers, $book_id, $inventory_id, $borrower_name, $book_name, $date_borrowed, $date_returned, $amount;

    // listener events in livewire components
    protected $listeners = ['destroy', 'unReturn', 'resetFieldsAndValidation'];

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

    // function to edit and show the specific borrower
    public function edit(Inventory $borrower)
    {
        // call the getQuantity function to get current stocks
        $this->getQuantity($borrower->book_id);

        $this->inventory_id = $borrower->id;
        $this->borrower_name = $borrower->borrower_id;
        $this->book_name = $borrower->book_id;

        // convert date borrowed to date format
        $this->date_borrowed = date('Y-m-d', strtotime($borrower->date_borrowed));

        // check if date returned is not null
        if ($borrower->date_returned != null) {
            // convert date borrowed to date returned
            $this->date_returned = date('Y-m-d', strtotime($borrower->date_returned));
        }

        $this->amount = $borrower->amount;
    }

    //function to update the inventory
    public function update()
    {
        //validate data
        $this->validate([
            'book_name' => 'required',
            'borrower_name' => 'required',
            'date_borrowed' => 'required',
            'amount' => 'required|integer|numeric|min:1',
        ]);

        //check if stocks is equal to 0
        if ($this->stocks == 0) {
            // get the current amount borrowed
            $amount = Inventory::where('id', $this->inventory_id)->first();

            /*
                if the amount is equal to the inputted amount
                this means that user did not change the amount field
            */
            if ($amount->amount == $this->amount) {
                // just update the inventory
                $this->updateInventory();
            }
            /*
                check if the amount is lesser than the inputted amount
                so we can know that the inputted amount is more than
                the original record in database
            */ else if ($amount->amount < $this->amount) {
                // we will show a validation error message
                $this->addError('stocks', 'You entered more than the available stock.');
            } else {
                // just update the inventory
                $this->updateInventory();
            }
        } else {
            // get the current amount borrowed
            $amount = Inventory::where('id', $this->inventory_id)->first();

            /*
                if the amount is equal to the inputted amount
                this means that user did not change the amount field
            */
            if ($amount->amount == $this->amount) {
                // just update the inventory
                $this->updateInventory();
            }
            /*
                check if the amount is lesser than the inputted amount
                so we can know that the inputted amount is more than
                the original record in database
            */ else if ($amount->amount < $this->amount) {
                /* 
                    check if stocks is same amount when we subtract
                    the original amount to the amount inputted by
                    the user
                */
                if ($this->stocks == ($this->amount - $amount->amount)) {
                    // just update the inventory
                    $this->updateInventory();
                }
                /* 
                    check if stocks is lesser amount than when we subtract
                    the original amount to the amount inputted by
                    the user
                */ else if ($this->stocks < ($this->amount - $amount->amount)) {
                    // we will show a validation error message
                    $this->addError('stocks', 'You entered more than the available stock.');
                } else {
                    // just update the inventory
                    $this->updateInventory();
                }
            } else {
                // just update the inventory
                $this->updateInventory();
            }
        }
    }

    // function for updating the inventory
    public function updateInventory()
    {
        if ($this->date_returned != null) {
            Inventory::where('id', $this->inventory_id)->update([
                'book_id' => $this->book_name,
                'borrower_id' => $this->borrower_name,
                'date_borrowed' => $this->date_borrowed,
                'date_returned' => $this->date_returned,
                'amount' => 0
            ]);
        } else {
            Inventory::where('id', $this->inventory_id)->update([
                'book_id' => $this->book_name,
                'borrower_id' => $this->borrower_name,
                'date_borrowed' => $this->date_borrowed,
                'amount' => $this->amount,
                'unreturn_amount' => $this->amount,
            ]);
        }


        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Inventory updated successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
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

    // function to confirm if user wants to delete the inventory
    public function destroyConfirm($id)
    {
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'id' => $id
        ]);
    }

    public function destroy($id)
    {
        Inventory::where('id', $id)->delete();
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Inventory deleted successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function to confirm if user wants to unreturn the inventory
    public function unReturnConfirm($id)
    {
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal:unreturn', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'id' => $id
        ]);
    }

    public function unReturn($id)
    {
        $unreturn_amount = Inventory::find($id);
        Inventory::where('id', $id)->update([
            'date_returned' => null,
            'amount' => $unreturn_amount->unreturn_amount
        ]);
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Inventory unreturn successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['book_name', 'borrower_name', 'date_borrowed', 'date_returned', 'amount', 'stocks']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    public function render()
    {
        $search = $this->search;

        $inventories = Inventory::with('borrowers:id,id,full_name')
            ->with('books:id,id,book_name')
            ->where('book_id', $this->book_id)
            ->whereHas('borrowers', function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('livewire.inventories.show-borrowers', [
            'inventories' => $inventories
        ]);
    }
}
