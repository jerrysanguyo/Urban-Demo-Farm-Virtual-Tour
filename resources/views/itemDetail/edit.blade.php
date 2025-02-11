@extends('layouts.welcome')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-8">
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
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span class="fs-3">{{ $item->name }}</span>
                        <a href="{{ route(Auth::user()->role . '.item.show', $item->id) }}">
                            <button class="btn btn-primary">Back</button>
                        </a>
                    </div>
                </div>
                <form action="{{ route(Auth::user()->role . '.itemDetail.update', ['item' => $item->id, 'itemDetail' => $itemDetail->id ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="title" class="form-control" placeholder="Leave a comment here"
                                        value="{{ $itemDetail->title }}" id="title"></input>
                                    <label for="title">Title:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="details" class="form-control" placeholder="" id="details">
                                        {{ old('details', $itemDetail->details ?? '') }}
                                    </textarea>
                                    <label for="details">Details:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection