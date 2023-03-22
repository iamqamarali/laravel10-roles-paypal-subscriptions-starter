@extends('layouts.empty')

@section('title', 'Dashboard | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="subscription-success bg-light min-vh-100 d-flex align-items-center justify-content-center">
            
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-12 ">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Thank you for your subscribing</h2>

                            {{-- if user need to change their password --}}
                            @if ($customer->should_change_password)                                
                                <p class="text-center">
                                    Before you can access your account, you need to set your password.
                                </p>

                                <p class="text-center">
                                    <a href="{{ route('newsubscriber.change-password-view') }}">Change Account Password</a>
                                </p>
                            @else
                                <p class="text-center">
                                    Go to your dashboard
                                </p>

                                <p class="text-center">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </p>
                            @endif
                            

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