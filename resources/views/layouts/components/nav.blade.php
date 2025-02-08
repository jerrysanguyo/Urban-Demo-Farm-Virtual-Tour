<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <img src="{{ asset('images/logo.webp') }}" alt="City of Taguig logo" class="logo-img me-3">
        <a class="navbar-brand" href="#">Urban Farm</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qr-scanner') }}">QR Code Scanner</a>
                </li>
                @if(Auth::check() && Auth::user()->role === 'superadmin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">CMS</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route(Auth::user()->role . '.type.index') }}">Types</a></li>
                            <li><a class="dropdown-item" href="{{ route(Auth::user()->role . '.item.index') }}">Items</a></li>
                            <li><a class="dropdown-item" href="#">Events</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>