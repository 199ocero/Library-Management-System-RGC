@extends('app')
@section('content')
    <div>
        <livewire:inventories />
    </div>
@endsection
@section('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#createBookBorrowedModal').modal('hide');
        });

        // hide validation error message when modal close

        $(document).ready(function() {
            $("#createBookBorrowedModal").on('hidden.bs.modal', function() {
                window.livewire.emit('resetFieldsAndValidation');
                $('.selectpicker').selectpicker('val', '');
            });
        });
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });

        function resetSelect() {
            $('.selectpicker').selectpicker();
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
    </script>
@endsection
