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
                    @foreach($details as $detail)
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card border shadow">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-4">{{ $detail->title }}</span>
                                                    @if (Auth::check() && Auth::user()->role === 'superadmin')
                                                        <div class="dropdown">
                                                            <a href="" class="btn btn-primary dropdown-toggle" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{ route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $detail->id]) }}"
                                                                        class="dropdown-item">Edit</a>
                                                                </li>
                                                                @if(Auth::check() && Auth::user()->role === 'superadmin')
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
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                {{ $detail->details }}
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
@endsection