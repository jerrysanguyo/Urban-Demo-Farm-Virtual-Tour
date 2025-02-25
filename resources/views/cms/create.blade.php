<div class="modal fade" id="create{{ $resource }}" tabindex="-1" aria-labelledby="create{{ $resource }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route(Auth::user()->role . '.' . $resource . '.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create{{ $resource }}Label">{{ $title }} creation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name"
                                autofocus>
                        </div>
                    </div>
                    @if($resource === 'item')
                        <div class="row mt-3">
                            <label for="type_id" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>
                            <div class="col-md-6">
                                <select name="type_id" id="type_id" class="form-select">
                                    @foreach ($subData as $mat)
                                        <option value="{{ $mat->id }}">{{ $mat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="picture" class="col-md-4 col-form-label text-md-end" name="picture">{{ __('Picture') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="picture" id="picture" class="form-control">
                            </div>
                        </div>
                    @endif
                    <div class="row mt-3">
                        <label for="remarks" class="col-md-4 col-form-label text-md-end">{{ __('Remarks') }}</label>
                        <div class="col-md-6">
                            <input id="remarks" type="text" class="form-control @error('remarks') is-invalid @enderror"
                                name="remarks" value="{{ old('remarks') }}" placeholder="Remarks" required
                                autocomplete="remarks" autofocus>
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