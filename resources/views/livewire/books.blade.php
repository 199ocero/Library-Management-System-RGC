<div>
    @include('livewire.book-create')
    @include('livewire.book-edit')

    <div class="d-flex flex-column  justify-content-center vh-100">

        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Management</h1>
            <p>Easily organize and keep track of your book collection by managing details such
                as ISBN, book title, quantity, and author.</p>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <input type="search" wire:model='search' class="form-control" placeholder="Search anything...">
                </div>
                <div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createBookModal">
                        Create Book
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-danger ms-2">Back</a>
                </div>
            </div>



            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <th scope="row">{{ $books->firstItem() + $loop->index }}</th>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->book_name }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td class="text-center">
                                <button type="button" wire:click="edit({{ $book }})" data-bs-toggle="modal"
                                    data-bs-target="#editBookModal" class="btn btn-sm btn-secondary">
                                    Edit
                                </button>
                                <button type="button" wire:click='destroyConfirm({{ $book->id }})'
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
            {{ $books->links() }}
        </div>

    </div>
</div>
