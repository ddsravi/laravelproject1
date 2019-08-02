@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<table class="table">
						<thead>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</thead>
						<tbody>
							@foreach($user as $ud)
							<tr>
								<td>{{ $ud->id }}</td>
								<td>{{ $ud->name }}</td>
								<td>{{ $ud->email }}</td>
								<td>{{ $ud->role }}</td>
								<td><a href="">view</a>
								<a href="update/{{$ud->id}}">Edit</a>
								<a href="delete/{{$ud->id}}">delete</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
