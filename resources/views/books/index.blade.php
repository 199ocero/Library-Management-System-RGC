@extends('welcome')
@section('content')
    <div class="d-flex flex-column  justify-content-center vh-100">
        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Management</h1>
            <p>Easily organize and keep track of your book collection by managing details such
                as ISBN, book title, quantity, and author.</p>
        </div>
        <!-- Button trigger modal -->
        <div>
            <a href="{{ route('home') }}" class="btn btn-danger float-end ms-3">Back</a>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#bookModal">
                Create Book
            </button>

        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->book_name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->quantity }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('book.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="isbn" class="form-label">International Standard Book Number (ISBN)</label>
                            <input type="text" class="form-control" id="isbn" name="isbn"
                                placeholder="Enter ISBN">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="book_name" class="form-label">Book Name</label>
                            <input type="text" class="form-control" id="book_name" name="book_name"
                                placeholder="Enter Book Name">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author"
                                placeholder="Enter Author Name">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter Quantity">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
