<div>
    {{-- @include('livewire.borrowers.borrowers-create')
    @include('livewire.borrowers.borrowers-edit') --}}

    <div class="d-flex flex-column  justify-content-center vh-100">

        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Inventory</h1>
            <p>You can check the number of books that are currently borrowed.</p>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <input type="search" wire:model='search' class="form-control" placeholder="Search anything...">
                </div>
                <div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createBookBorrowedModal">
                        Create Borrowed Book
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-danger ms-2">Back</a>
                </div>
            </div>



            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Book Quantity</th>
                        <th scope="col">Book In Stocks</th>
                        <th scope="col">Borrowers</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowed_books as $borrowed_book)
                        <tr>
                            <th scope="row">{{ $borrowed_books->firstItem() + $loop->index }}</th>
                            <td>{{ $borrowed_book->book_id }}</td>
                            <td>{{ $borrowed_book->borrower_id }}</td>
                            <td>123</td>
                            <td>123</td>
                            <td class="text-center">
                                <button type="button" wire:click="edit({{ $borrowed_book }})" data-bs-toggle="modal"
                                    data-bs-target="#editBorrowerModal" class="btn btn-sm btn-secondary">
                                    Edit
                                </button>
                                <button type="button" wire:click='destroyConfirm({{ $borrowed_book->id }})'
                                    class="btn btn-sm btn-danger">
                                    Return
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
            {{ $borrowed_books->links() }}
        </div>

    </div>
</div>
