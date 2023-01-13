@extends('welcome')
@section('content')
    <div class="d-flex flex-column  justify-content-center vh-100">
        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Book Management</h1>
            <p>Easily organize and keep track of your book collection by managing details such
                as ISBN, book title, quantity, and author.</p>
        </div>
        <!-- Button trigger modal -->
        <div class="mb-3">
            <a href="{{ route('home') }}" class="btn btn-danger float-end ms-3">Back</a>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#bookModal">
                Create Book
            </button>

        </div>

        {{-- Table --}}
        <table class="table" id="bookTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
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
                        <td>
                            <button type="button" class="btn btn-sm btn-secondary">
                                Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <livewire:books-modal />
@endsection


@section('script')
    <script>
        // datatable
        $('#bookTable').DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            pageLength: 5
        });
    </script>
@endsection
