<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class ShowBorrowers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $book_id;

    public function render()
    {
        $borrowers = Inventory::where('book_id', $this->book_id)->paginate(5);

        return view('livewire.inventories.show-borrowers', [
            'borrowers' => $borrowers
        ]);
    }
}
