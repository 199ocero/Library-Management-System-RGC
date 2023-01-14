<div>
    <div wire:ignore.self class="modal fade" id="createBookModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Book Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click='resetFields'
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="isbn" class="form-label">International Standard Book Number (ISBN)</label>
                            <input type="text" class="form-control" id="isbn" wire:model="isbn"
                                placeholder="Enter ISBN" maxlength="10" minlength="10">
                            <div class="form-text">Note: Please enter exactly 10 digits/character for the ISBN number.
                            </div>
                            @error('isbn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="book_name" class="form-label">Book Name</label>
                            <input type="text" class="form-control" id="book_name" wire:model="book_name"
                                placeholder="Enter Book Name">
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" wire:model="author"
                                placeholder="Enter Author Name">
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" wire:model="quantity"
                                placeholder="Enter Quantity">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click='resetFields'
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
