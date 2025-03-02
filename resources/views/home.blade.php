@extends('layouts.welcome')

@section('content')
<div class="container">
    
    <div class="row mt-3">
        <div class="col-12">
            <form action="{{ route('home') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search for an item..." value="{{ request()->query('query') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row mt-2">
        @foreach ($items as $item)
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card border shadow mt-3">
                <div class="card-header bg-success text-white text-center">
                    <span class="fs-5">
                        {{ $item->name }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($item->picture->file_path) }}" alt="{{ $item->name }}" class="w-20 h-20">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('item.show', $item->id) }}">
                                    <button type="button" class="btn btn-success">View more details!</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
