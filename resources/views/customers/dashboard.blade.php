@extends('layouts.app-customer')

@section('title', 'Dashboard | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="dashboard bg-light">
        <div class="container py-4">
            
            <div class="card"> 
                <div class="card-body m-3">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Dashboard</h3>
                    </div>


                </div>
            </div>


            <div class=" py-6 my-5 "></div>
        </div>
    </div>    
@endsection


@push('scripts')
<script>
    
    
</script>
@endpush