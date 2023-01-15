@extends('app')
@section('content')
    <div>
        <livewire:show-borrowers :book_id="$book_id">
    </div>
@endsection
@section('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#editBookBorrowedModal').modal('hide');
        });

        // hide validation error message when modal close

        $(document).ready(function() {
            $("#editBookBorrowedModal").on('hidden.bs.modal', function() {
                window.livewire.emit('resetFieldsAndValidation');
            });
        });

        function populateSelect($borrower_id, $book_id) {
            $('.selectpickerBorrower').selectpicker('val', $borrower_id);
            $('.selectpickerBook').selectpicker('val', $book_id);
        }

        function resetSelect() {
            $('.selectpickerBorrower').selectpicker();
            $('.selectpickerBook').selectpicker();
        }
        // sweet alert
        window.addEventListener('swal', function(e) {
            Swal.fire({
                title: e.detail.title,
                icon: e.detail.icon,
                iconColor: e.detail.iconColor,
                timer: 3000,
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
            });
        });

        window.addEventListener('swal:unreturn', function(e) {
            Swal.fire({
                title: e.detail.title,
                text: e.detail.text,
                icon: e.detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, unreturn it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('unReturn', e.detail.id);
                }
            })
        });
    </script>
@endsection
