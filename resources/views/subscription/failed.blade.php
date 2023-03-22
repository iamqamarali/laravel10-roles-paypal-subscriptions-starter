@extends('layouts.empty')

@section('title', 'Dashboard | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="subscription-failed bg-light min-vh-100 d-flex align-items-center justify-content-center">
            
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-12 ">
                    <div class="card">
                        <div class="card-body p-5 text-center">
                            <h2 class="text-center mb-4">Sorry to see you go, subscription failed!</h2>
                            
                            <a href="{{ route('checkouts.online-arbitrage-lead') }}" class="mt-2">
                                Pleae try again from here
                            </a>

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