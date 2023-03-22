@extends('layouts.app')

@section('title', 'Dashboard | ' . config('app.name', 'Laravel') )
    

@section('content')
<section class=" group-create-page bg-light">
    <div class="container py-5">
        <div class="row ">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body m-3">
                        <div class="d-flex justify-content-between mb-3">
                            <h3>Please Choose a group that you want to see leads for</h3>
                        </div>
                        @include('partials.errors')
                        @include('partials.messages')

                        <form action="{{ route('newsubscriber.choose-groups') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Group Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name')?? $group->name  }}"  placeholder="Group Name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" value="{{ old('description')?? $group->description }}" placeholder="Description"></textarea>
                            </div>
                            
                            <button class="btn btn-dark">
                                Save
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection


@push('scripts')
<script>
    
    
</script>
@endpush