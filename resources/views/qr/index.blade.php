@extends('layouts.welcome')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            @include('cms.components.alert')
            
            <!-- Printable Card Wrapper -->
            <div class="card shadow-lg border-0 rounded-3 p-4 printable-area">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Left Section: Text -->
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('images/logo.webp') }}" alt="" class="w-50">
                            <h4 class="fw-bold text-uppercase">{{ $item->name }}</h4>
                        </div>
                        <!-- Right Section: QR Code -->
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('storage/' . $item->qr->file_path) }}" alt="QR Code" class="img-fluid w-75 shadow-sm rounded">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Print Button (won’t show on printed page) -->
            <div class="text-center mt-3 d-print-none">
                <button class="btn btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .printable-area, 
    .printable-area * {
        visibility: visible;
    }
    .printable-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
        border: none !important;
    }
    .d-print-none {
        display: none !important;
    }
}
</style>

@endsection
