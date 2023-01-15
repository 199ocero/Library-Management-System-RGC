<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowBorrowers extends Component
{
    public $book_id;

    public function render()
    {
        return view('livewire.inventories.show-borrowers', ['book_id' => $this->book_id]);
    }
}
