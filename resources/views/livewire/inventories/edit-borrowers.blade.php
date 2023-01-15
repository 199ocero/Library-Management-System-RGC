<div>
    <div wire:ignore.self class="modal fade" id="editBookBorrowedModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit and Update Borrower Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='resetFieldsAndValidation'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div wire:ignore>
                                <label for="borrower_name" class="form-label">Select Borrower Name</label>
                                <select wire:model='borrower_name' class="form-control selectpickerBorrower"
                                    data-live-search="true" data-size="5" title="Select borrower...">
                                    @foreach ($borrowers as $borrower)
                                        <option value="{{ $borrower->id }}">{{ $borrower->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('borrower_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div wire:ignore>
                                <label for="book_name" class="form-label">Select Book Name</label>
                                <select wire:model='book_name' class="form-control selectpickerBook"
                                    data-live-search="true" data-size="5" title="Select book...">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->book_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date_borrowed" class="form-label">Select Date Borrowed</label>
                            <input type="date" class="form-control" id="date_borrowed" wire:model="date_borrowed">
                            @error('date_borrowed')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Books to be Borrowed</label>
                            <input type="number" class="form-control" id="amount" wire:model="amount"
                                placeholder="Enter amount">
                            @error('amount')
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
