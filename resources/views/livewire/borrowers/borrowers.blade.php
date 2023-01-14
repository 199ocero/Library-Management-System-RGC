<div>
    @include('livewire.borrowers.borrowers-create')
    @include('livewire.borrowers.borrowers-edit')

    <div class="d-flex flex-column  justify-content-center vh-100">

        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Borrowers</h1>
            <p>Stay informed about who has borrowed your books and their contact information, including full name,
                address, and phone number.</p>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <input type="search" wire:model='search' class="form-control" placeholder="Search anything...">
                </div>
                <div>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#createBorrowerModal">
                        Create Borrower
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-danger ml-3">Back</a>
                </div>
            </div>



            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowers as $borrower)
                        <tr>
                            <th scope="row">{{ $borrowers->firstItem() + $loop->index }}</th>
                            <td>{{ $borrower->student_id }}</td>
                            <td>{{ $borrower->full_name }}</td>
                            <td>{{ $borrower->address }}</td>
                            <td>{{ $borrower->contact_number }}</td>
                            <td class="text-center">
                                <button type="button" wire:click="edit({{ $borrower }})" data-toggle="modal"
                                    data-target="#editBorrowerModal" class="btn btn-sm btn-secondary">
                                    Edit
                                </button>
                                <button type="button" wire:click='destroyConfirm({{ $borrower->id }})'
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <span>No record found.</span>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{ $borrowers->links() }}
        </div>

    </div>
</div>
