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
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="description" class="form-control" placeholder="Leave a comment here"
                                    id="description"></textarea>
                                <label for="description">Details:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>