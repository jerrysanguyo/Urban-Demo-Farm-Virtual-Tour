@extends('layouts.welcome')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-12">
            @include('cms.components.alert')
            <div class="card shadow border">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <span class="fs-3">{{ $item->name }}</span>
                            @if(Auth::check() && Auth::user()->role === 'superadmin')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#itemDetailCreate">
                                Add detail
                            </button>
                            @include('cms.modal.create-details')
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($item->picture->file_path) }}" alt="{{ $item->name }}">
                    </div>
                    @include('cms.components.accordion')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection