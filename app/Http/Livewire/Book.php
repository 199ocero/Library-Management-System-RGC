<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Book;
use App\Models\Books;
use Livewire\Component;
use Livewire\WithPagination;

class Book extends Component
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

    // listener for destroy
    protected $listeners = ['destroy'];

    // create a rule to validate the input fields
    protected $rules = [
        'isbn' => 'required|string',
        'book_name' => 'required|string',
        'author' => 'required|string',
        'quantity' => 'required|integer',
    ];

    // function to store books
    public function store()
    {
        $this->validate();

        // save book if validation is success
        Books::create([
            'isbn' => $this->isbn,
            'book_name' => $this->book_name,
            'author' => $this->author,
            'quantity' => $this->quantity,
        ]);

        // call this function to reset modal fields
        $this->resetFields();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Book created successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function for reseting the fields
    public function resetFields()
    {
        $this->isbn = '';
        $this->book_name = '';
        $this->author = '';
        $this->quantity = '';
    }

    // function to edit and show the specific book
    public function edit(Books $book)
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

        Books::where('id', $this->book_id)->update([
            'isbn' => $this->isbn,
            'book_name' => $this->book_name,
            'author' => $this->author,
            'quantity' => $this->quantity,
        ]);

        // call this function to reset modal fields
        $this->resetFields();

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
        Books::where('id', $id)->delete();
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Book deleted successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }
    public function render()
    {
        $books = Books::latest()
            ->where('isbn', 'like', '%' . $this->search . '%')
            ->orWhere('book_name', 'like', '%' . $this->search . '%')
            ->orWhere('author', 'like', '%' . $this->search . '%')
            ->orWhere('quantity', 'like', '%' . $this->search . '%')
            ->paginate(5);
        return view('livewire.book', ['books' => $books]);
    }
}
