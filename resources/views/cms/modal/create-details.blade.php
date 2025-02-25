<div class="modal fade" id="itemDetailCreate" tabindex="-1" aria-labelledby="itemDetailCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="itemDetailCreateLabel">Detail creation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route(Auth::user()->role . '.itemDetail.store', ['item' => $item->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <label for="picture" class="col-md-2 col-form-label"
                            name="picture">{{ __('Picture:') }}</label>
                        <div class="col-md-10">
                            <input type="file" name="picture" id="picture" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="title" class="form-control" placeholder="Leave a comment here"
                                    id="title"></input>
                                <label for="title">Title:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="details" class="form-control" placeholder="Leave a comment here"
                                    id="details"></textarea>
                                <label for="details">Details:</label>
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