<div>
    @include('livewire.inventories.inventories_create')

    <div class="d-flex flex-column  justify-content-center vh-100">

        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Inventory</h1>
            <p>You can check the number of books that are currently borrowed.</p>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <input type="search" wire:model='search' class="form-control" placeholder="Search book...">
                </div>
                <div>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#createBookBorrowedModal">
                        Create Borrowed Book
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-danger ml-3">Back</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Book Quantity</th>
                        <th scope="col">Book In Stocks</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowed_books as $borrowed_book)
                        <tr>
                            <th scope="row">{{ $borrowed_books->firstItem() + $loop->index }}</th>
                            <td>{{ $borrowed_book->books[0]->book_name }}</td>
                            <td>{{ $borrowed_book->books[0]->quantity }}</td>
                            <td>{{ $borrowed_book->books[0]->quantity - $borrowed_book->total_amount }}</td>
                            <td class="text-center">
                                <a href="{{ route('book-inventory.borrower', $borrowed_book->book_id) }}" type="button"
                                    class="btn btn-sm btn-secondary">
                                    Check Borrowers
                                </a>
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
