<div>
    <div wire:ignore.self class="modal fade" id="createBookBorrowedModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Borrower Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='resetFieldsAndValidation'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3" wire:ignore>
                            <label for="student_id" class="form-label">Select Borrower Name</label>
                            <select wire:model='borrower_name' class="form-control selectpicker" data-live-search="true"
                                data-size="5" title="Select borrower...">
                                @foreach ($borrowers as $borrower)
                                    <option value="{{ $borrower->id }}">{{ $borrower->full_name }}</option>
                                @endforeach
                            </select>
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="student_id" class="form-label">Select Book Name</label>
                            <select wire:model='book_name' class="form-control selectpicker" data-live-search="true"
                                data-size="5" title="Select book...">
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="resetSelect()"
                            wire:click='resetFieldsAndValidation' data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
