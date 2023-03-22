@extends('layouts.empty')

@section('title', 'Dashboard | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="change-password bg-light min-vh-100 d-flex align-items-center justify-content-center">
            
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-12 ">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Set Password</h2>
                            <p class="text-center">
                                Please set your password to access your account.
                            </p>
                            
                            <form action="{{ route('newsubscriber.change-password') }}" method="post">
                                @csrf

                                @include('partials.errors')
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" >
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" >
                                </div>

                                <div class="d-grid mt-3">
                                    <button class="btn btn-dark">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>    
@endsection


@push('scripts')
<script>
    
    
</script>
@endpush