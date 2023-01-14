<div>
    <div wire:ignore.self class="modal fade" id="editBorrowerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit and Update Borrower Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click='resetFieldsAndValidation'
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" wire:model="student_id"
                                placeholder="Enter Student ID" maxlength="10" minlength="10">
                            <div class="form-text">Note: Please enter exactly 10 digits/character for the Student ID.
                            </div>
                            @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" wire:model="full_name"
                                placeholder="Enter Full Name">
                            @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" wire:model="address"
                                placeholder="Enter Address">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contact_numer" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact_numer" wire:model="contact_numer"
                                placeholder="Enter Quantity">
                            @error('contact_numer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click='resetFieldsAndValidation'
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
