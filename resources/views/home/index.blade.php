@extends('welcome')
@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Books Management</h5>
                        <p class="card-text">Easily organize and keep track of your book collection by managing details such
                            as ISBN, book title, quantity, and author.</p>
                        <a href="#" class="btn btn-primary">Check Books Management</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Books Borrowers</h5>
                        <p class="card-text">Stay informed about who has borrowed your books and their contact information,
                            including full name, address, and phone number.</p>
                        <a href="#" class="btn btn-primary">Check Books Management</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
