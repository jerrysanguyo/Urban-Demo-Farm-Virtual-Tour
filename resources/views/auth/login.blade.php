@extends('layouts.welcome')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 600px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card-body px-5">
                    <div class="text-center">
                        <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="img-fluid"
                            style="max-width: 100px;">
                    </div>
                    <h3 class="text-center fw-bold mb-4">Login</h3>
                    <form method="POST" action="{{ route('login.check') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control rounded-pill shadow-sm" id="email"
                                placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill shadow-sm" id="password"
                                placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill shadow mb-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection