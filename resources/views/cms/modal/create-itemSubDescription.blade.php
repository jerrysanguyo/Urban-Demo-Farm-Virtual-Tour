<div class="modal fade" id="itemSubDescription-{{ $detail->id }}" tabindex="-1"
    aria-labelledby="itemSubDescriptionLabel-{{ $detail->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="itemSubDescriptionLabel-{{ $detail->id }}">Detail creation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route(Auth::user()->role . '.subDescription.store', ['itemDetail' => $detail->id, 'item' => $item->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div id="description-rows-{{ $detail->id }}">
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="description[]" class="form-control" placeholder="Leave a comment here" id="description0-{{ $detail->id }}"></textarea>
                                    <label for="description0-{{ $detail->id }}">Details:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button to add a new row -->
                    <button type="button" id="addRowButton-{{ $detail->id }}" class="btn btn-secondary mt-2">Add Row</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    let rowCount = 1;
    const addRowButton = document.getElementById('addRowButton-{{ $detail->id }}');
    const descriptionRows = document.getElementById('description-rows-{{ $detail->id }}');

    if (addRowButton && descriptionRows) {
        addRowButton.addEventListener('click', function() {
            console.log('Add Row button clicked'); // For debugging
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mt-3');
            newRow.innerHTML = `
                <div class="col-12">
                    <div class="form-floating">
                        <textarea name="description[]" class="form-control" placeholder="Leave a comment here" id="description${rowCount}-{{ $detail->id }}"></textarea>
                        <label for="description${rowCount}-{{ $detail->id }}">Details:</label>
                    </div>
                </div>
            `;
            descriptionRows.appendChild(newRow);
            rowCount++;
        });
    } else {
        console.error('Add row button or description container not found.');
    }
})();
</script>