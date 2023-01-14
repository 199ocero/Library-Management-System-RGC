<?php

namespace App\Http\Livewire;

use App\Models\Borrower;
use Livewire\Component;
use Livewire\WithPagination;

class Borrowers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // declare variable for search filter
    public $search = '';

    // to reset the page to page 1
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $borrowers = Borrower::latest()
            ->where('student_id', 'like', '%' . $this->search . '%')
            ->orWhere('full_name', 'like', '%' . $this->search . '%')
            ->orWhere('address', 'like', '%' . $this->search . '%')
            ->orWhere('contact_number', 'like', '%' . $this->search . '%')
            ->paginate(5);
        return view('livewire.borrowers.borrowers', ['borrowers' => $borrowers]);
    }
}
