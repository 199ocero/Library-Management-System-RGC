<div>
    @include('livewire.inventories.edit-borrowers')
    <div class="d-flex flex-column  justify-content-center vh-100">

        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Inventory - Check Borrowers</h1>
            <p>You can check the number of borrowers who borrowed this book.</p>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <input type="search" wire:model='search' class="form-control" placeholder="Search borrower...">
                </div>
                <div>
                    <a href="{{ route('book-inventory') }}" class="btn btn-danger ml-3">Back</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Book Borrower</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Borrowed</th>
                        <th scope="col">Date Returned</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventories as $inventory)
                        <tr>
                            <th scope="row">{{ $inventories->firstItem() + $loop->index }}</th>
                            <td>{{ $inventory->books[0]->book_name }}</td>
                            <td>{{ $inventory->borrowers[0]->full_name }}</td>
                            <td>{{ $inventory->amount }}</td>
                            <td>{{ $inventory->date_borrowed->format('F j, Y') }}</td>
                            <td>{{ $inventory->date_returned }}</td>
                            <td class="text-center">
                                <button type="button" onclick="populateSelect({{ $inventory->borrowers[0]->id }})"
                                    wire:click="edit({{ $inventory }})" data-toggle="modal"
                                    data-target="#editBookBorrowedModal" class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                                @if (empty($inventory->date_returned))
                                    <button type="button" class="btn btn-sm btn-secondary">
                                        Return Book
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm btn-warning">
                                        Unreturn Book
                                    </button>
                                @endif

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
            {{ $inventories->links() }}
        </div>

    </div>
</div>
