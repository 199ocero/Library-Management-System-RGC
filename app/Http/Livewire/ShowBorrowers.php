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

    public $books, $borrowers, $book_id, $inventory_id, $borrower_name, $book_name, $date_borrowed, $date_returned, $amount;

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['unReturn', 'resetFieldsAndValidation'];

    public function mount()
    {
        $this->books = Book::latest()->get();
        $this->borrowers = Borrower::latest()->get();
    }

    // function to edit and show the specific borrower
    public function edit(Inventory $borrower)
    {
        $this->inventory_id = $borrower->id;
        $this->borrower_name = $borrower->borrower_id;
        $this->book_name = $borrower->book_id;
        $this->date_borrowed = date('Y-m-d', strtotime($borrower->date_borrowed));
        if ($borrower->date_returned != null) {
            $this->date_returned = date('Y-m-d', strtotime($borrower->date_returned));
        }
        $this->amount = $borrower->amount;
    }

    //function to update the inventory
    public function update()
    {
        $this->validate([
            'book_name' => 'required',
            'borrower_name' => 'required',
            'date_borrowed' => 'required',
            'amount' => 'required|integer',
        ]);
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
        $this->reset(['book_name', 'borrower_name', 'date_borrowed', 'date_returned', 'amount']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    public function render()
    {
        $inventories = Inventory::with('borrowers:id,id,full_name')
            ->with('books:id,id,book_name')
            ->where('book_id', $this->book_id)
            ->latest()
            ->paginate(5);

        return view('livewire.inventories.show-borrowers', [
            'inventories' => $inventories
        ]);
    }
}
