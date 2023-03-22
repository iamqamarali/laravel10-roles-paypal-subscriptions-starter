@extends('layouts.app')

@section('title', 'Users | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="dashboard bg-light">
        <div class="container py-4">
            
            <div class="row justify-content-center mt-4">
                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-body m-3">
                            <div class="d-flex justify-content-between mb-3">
                                <h3>Edit {{ $user->name }}</h3>
                            </div>

                            @include('partials.messages')
                            @include('partials.errors')


                            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')


                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Name"  value="{{ old('name') ? old('name'):$user->name }}" >
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') ? old('email'):$user->email }}">
                                </div>

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


            <div class=" py-6 my-5 "></div>
        </div>
    </div>    
@endsection


@push('scripts')
<script>

</script>
@endpush