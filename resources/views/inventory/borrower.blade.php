@extends('app')
@section('content')
    <div>
        <livewire:show-borrowers :book_id="$book_id">
    </div>
@endsection
