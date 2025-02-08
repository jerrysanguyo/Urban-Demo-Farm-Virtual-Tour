@extends('layouts.welcome')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-6">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow border">
                <div class="card-body">
                    <form action="{{ route(Auth::user()->role . '.' . $resource . '.update', $$resource->id) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <span class="fs-3">{{ $title }} update</span>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-lg-12 col-md-12">
                                <label for="name" class="form-label">{{ $resource }} name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $$resource->name }}">
                            </div>
                        </div>
                        @if($resource === 'item')
                            <div class="row mt-3">
                                <div class="col-lg-12 col-md-12">
                                    <label for="type_id" class="form-label text-md-end">Type:</label>
                                    <select name="type_id" id="type_id" class="form-select">
                                        @foreach ($subData as $mat)
                                            <option value="{{ $mat->id }}" {{ (old('type_id', $item->type_id) == $mat->id) ? 'selected' : '' }}>
                                                {{ $mat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="row mt-3">
                            <div class="col-lg-12 col-md-12">
                                <label for="remarks" class="form-label">Remarks:</label>
                                <input type="text" name="remarks" id="remarks" class="form-control"
                                    value="{{ $$resource->remarks }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <a href="{{ route(Auth::user()->role . '.' . $resource . '.index') }}">
                        <button class="btn btn-secondary mt-2">
                            Back
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection