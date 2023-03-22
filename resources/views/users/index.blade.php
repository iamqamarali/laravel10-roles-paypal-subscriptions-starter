@extends('layouts.app')

@section('title', 'Users | ' . config('app.name', 'Laravel') )
    

@section('content')
    <div class="dashboard bg-light">
        <div class="container py-4">
            
            <div class="card">
                <div class="card-body m-3">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Users</h3>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-dark ">Create New Admin</a>
                    </div>

                    @include('partials.messages')

                    <table class="table mb-5">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Active Subscription</th>
                            <th>Date Created</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user) 
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->haveActiveSubscription() ? 'active' : 'cancelled' }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>                                    
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="text-dark text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                            <ul class="dropdown-menu dropdown-menu-end " >
                                                <li>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="dropdown-item">Edit</a>
                                                </li>
                                            </ul>
                                        </div>                 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}

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