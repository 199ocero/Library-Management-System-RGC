<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class BooksModal extends Component
{
    // declare variable from books livewire component
    public $isbn, $book_name, $author, $quantity;

    // create a rule to validate the input fields
    protected $rules = [
        'isbn' => 'required|string',
        'book_name' => 'required|string',
        'author' => 'required|string',
        'quantity' => 'required|integer',
    ];

    // create a function to save books
    public function saveBook()
    {
        $this->validate();

        // save book if validation is success
        Book::create([
            'isbn' => $this->isbn,
            'book_name' => $this->book_name,
            'author' => $this->author,
            'quantity' => $this->quantity,
        ]);

        // page that the user came from before
        return redirect(request()->header('Referer'));
    }
    // render the livewire component
    public function render()
    {
        return view('livewire.books-modal');
    }
}
