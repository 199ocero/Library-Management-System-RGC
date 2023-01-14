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
    public $borrower_id, $student_id, $full_name, $address, $contact_number;

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
        'student_id' => 'required|string|size:10|unique:borrowers',
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

    // function to edit and show the specific borrower
    public function edit(Borrower $borrower)
    {
        $this->borrower_id = $borrower->id;
        $this->student_id = $borrower->student_id;
        $this->full_name = $borrower->full_name;
        $this->address = $borrower->address;
        $this->contact_number = $borrower->contact_number;
    }

    //function to update the borrower
    public function update()
    {
        $validatedData = $this->validate([
            'student_id' => 'required|string|size:10',
            'full_name' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'required|string|size:11|digits:11',
        ]);

        Borrower::where('id', $this->borrower_id)->update($validatedData);

        // call this to reset modal fields and validation
        $this->resetFieldsAndValidation();

        // dispatch event to close the modal
        $this->dispatchBrowserEvent('close-modal');

        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Borrower updated successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    // function to confirm if user wants to delete the borrower
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
        Borrower::where('id', $id)->delete();
        // dispatch event to show sweet alert 2
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Borrower deleted successfully!',
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
