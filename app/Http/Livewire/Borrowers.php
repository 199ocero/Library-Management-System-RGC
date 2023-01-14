<?php

namespace App\Http\Livewire;

use App\Models\Borrower;
use Livewire\Component;
use Livewire\WithPagination;

class Borrowers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // declare variable from borrower livewire component
    public $student_id, $full_name, $address, $contact_number;

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
        'student_id' => 'required|string|size:10',
        'full_name' => 'required|string',
        'address' => 'required|string',
        'contact_number' => 'required|string|size:11|digits:11',
    ];

    // function to store borrower
    public function store()
    {
        $this->validate();

        // save borrower if validation is success
        Borrower::create([
            'student_id' => $this->student_id,
            'full_name' => $this->full_name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
        ]);

        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Borrower created successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function for reseting the fields
    public function resetFieldsAndValidation()
    {
        // call this to reset modal fields
        $this->reset(['student_id', 'full_name', 'address', 'contact_number']);

        // call this to reset validation error message
        $this->resetValidation();
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
