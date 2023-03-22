@if (session('success'))
    {{-- success alert --}}

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('danger'))
    {{-- danger alert --}}

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> {{ session('danger') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('warning'))
    {{-- warning alert --}}

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message: </strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif