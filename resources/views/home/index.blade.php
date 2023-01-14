@extends('app')
@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center vh-100">
        <div class="mb-5 text-center">
            <h1 class="fw-bold fs-2">Welcome to Library Management System</h1>
            <p>A library management system that allows for the efficient organization and management of books, borrowers,
                and inventory. </p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Book Management</h5>
                        <p class="card-text">Easily organize and keep track of your book collection by managing details such
                            as ISBN, book title, quantity, and author.</p>
                        <a href="{{ route('book-management') }}" class="btn btn-primary">Check Book Management</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Book Borrowers</h5>
                        <p class="card-text">Stay informed about who has borrowed your books and their contact information,
                            including full name, address, and phone number.</p>
                        <a href="#" class="btn btn-primary">Check Book Borrowers</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
