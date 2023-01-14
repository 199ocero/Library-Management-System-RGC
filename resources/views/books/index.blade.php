@extends('app')
@section('content')
    <div>
        <livewire:books />
    </div>
@endsection
@section('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#createBookModal').modal('hide');
            $('#editBookModal').modal('hide');
        });


        // sweet alert
        window.addEventListener('swal', function(e) {
            Swal.fire({
                title: e.detail.title,
                icon: e.detail.icon,
                iconColor: e.detail.iconColor,
                timer: 3000,
                toast: true,
                position: 'top-right',
                toast: true,
                showConfirmButton: false,
            });
        });

        window.addEventListener('swal:confirm', function(e) {
            Swal.fire({
                title: e.detail.title,
                text: e.detail.text,
                icon: e.detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('destroy', e.detail.id);
                }
            })
        });
    </script>
@endsection