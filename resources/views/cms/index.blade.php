@extends('layouts.welcome')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-1">
            <span class="fs-3">List of {{ $title }}</span>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $resource }}">
                Create a {{ $title }}
            </button>
            @include('cms.create')
        </div>
        <div class="card shadow border">
            <div class="card-body">
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
                <table class="table table-striped border" id="{{ $resource }}-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Remarks</th>
                            @if(Request::is('superadmin/item'))
                                <th>Type</th>
                                <th>Qr code</th>
                            @endif
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->remarks }}</td>
                                @if(Request::is('superadmin/item'))
                                    <td>{{ $item->type->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . (optional($item->qr)->file_path ?: 'default.png')) }}"
                                            alt="QR Code" style="width: 20%;">
                                    </td>
                                @endif
                                <td>{{ $item->createdBy->name }}</td>
                                <td>{{ $item->updatedBy->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="" class="btn btn-primary dropdown-toggle" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route(Auth::user()->role . '.' . $resource . '.edit', $item->id) }}"
                                                    class="dropdown-item">Edit</a>
                                            </li>
                                            <li>
                                                <a href="{{ route(Auth::user()->role . '.' . $resource . '.show', $item->id) }}"
                                                    class="dropdown-item">Details</a>
                                            </li>
                                            @if(Auth::user()->role === 'superadmin')
                                                <li>
                                                    <form
                                                        action="{{ route(Auth::user()->role . '.' . $resource . '.destroy', $item->id) }}"
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#{{ $resource }}-table').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 10,
                    "order": [[0, "desc"]],
                });
            });
        </script>
    @endpush
@endsection