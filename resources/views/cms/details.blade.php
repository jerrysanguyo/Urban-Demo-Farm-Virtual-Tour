@extends('layouts.welcome')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <div class="col-lg-12">
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
                        @foreach($details as $detail)
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="card border shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="fs-2">{{ $detail->title }}</span>
                                                        @if (Auth::check() && Auth::user()->role === 'superadmin')
                                                            <div class="dropdown">
                                                                <a href="" class="btn btn-primary dropdown-toggle" role="button"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <button type="button" class="dropdown-item"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#itemSubDescription-{{ $detail->id }}">
                                                                            Add sub detail
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $detail->id]) }}"
                                                                            class="dropdown-item">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route(Auth::user()->role . '.itemDetail.destroy', ['item' => $item->id, 'itemDetail' => $detail->id]) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="dropdown-item"
                                                                                onclick="return confirm('Are you sure you want to delete this ' . $resource . ' ?')">Delete</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 p-5">
                                                    <div
                                                        class="d-flex flex-wrap justify-content-center align-items-center gap-3">
                                                        <div class="d-flex justify-content-center">
                                                            @if ($detail->picture != NULL)
                                                                <img src="{{ asset($detail->picture->file_path) }}"
                                                                    alt="details_picture" class="w-50">
                                                            @endif
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span class="fs-5 text-center">{{ $detail->details }}</span>
                                                            <ul>
                                                                @if ($detail->details === NULL)
                                                                    @foreach ($subDetails as $subDetail)
                                                                        <li class="fs-5">
                                                                            {{ $subDetail->description }}
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($item->detail != NULL)
        @include('cms.modal.create-itemSubDescription')
    @endif
@endsection