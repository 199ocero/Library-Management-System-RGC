<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // declare variable from books livewire component
    public $book_id, $isbn, $book_name, $author, $quantity;

    // declare variable for search filter
    public $search = '';

    // to reset the page to page 1
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // listener for destroy an resetFieldsAndValidation
    protected $listeners = ['destroy', 'resetFieldsAndValidation'];

    // create a rule to validate the input fields
    protected $rules = [
        'isbn' => 'required|string|size:10|digits:10',
        'book_name' => 'required|string',
        'author' => 'required|string',
        'quantity' => 'required|integer',
    ];

    // function to store books
    public function store()
    {
        $this->validate();

        // save book if validation is success
        Book::create([
            'isbn' => $this->isbn,
            'book_name' => $this->book_name,
            'author' => $this->author,
            'quantity' => $this->quantity,
        ]);

        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Book created successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['isbn', 'book_name', 'author', 'quantity']);

        // call this to reset validation error message
        $this->resetValidation();
    }

    // function to edit and show the specific book
    public function edit(Book $book)
    {
        $this->book_id = $book->id;
        $this->isbn = $book->isbn;
        $this->book_name = $book->book_name;
        $this->author = $book->author;
        $this->quantity = $book->quantity;
    }

    //function to update the book
    public function update()
    {
        $this->validate();

        Book::where('id', $this->book_id)->update([
            'isbn' => $this->isbn,
            'book_name' => $this->book_name,
            'author' => $this->author,
            'quantity' => $this->quantity,
        ]);

        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Book updated successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function to confirm if user wants to delete the book
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
        Book::where('id', $id)->delete();
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Book deleted successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }
    public function render()
    {
        $books = Book::latest()
            ->where('isbn', 'like', '%' . $this->search . '%')
            ->orWhere('book_name', 'like', '%' . $this->search . '%')
            ->orWhere('author', 'like', '%' . $this->search . '%')
            ->orWhere('quantity', 'like', '%' . $this->search . '%')
            ->paginate(5);
        return view('livewire.books', ['books' => $books]);
    }
}
