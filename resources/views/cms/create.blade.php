<div class="modal fade" id="create{{ $resource }}" tabindex="-1" aria-labelledby="create{{ $resource }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route(Auth::user()->role .'.'. $resource . '.store') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create{{ $resource }}Label">{{ $title }} creation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Name"
                            required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="remarks" class="col-md-4 col-form-label text-md-end">{{ __('Remarks') }}</label>
                        <div class="col-md-6">
                            <input id="remarks" type="text" class="form-control @error('remarks') is-invalid @enderror"
                            name="remarks" value="{{ old('remarks') }}" placeholder="Remarks"
                            required autocomplete="remarks" autofocus>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>