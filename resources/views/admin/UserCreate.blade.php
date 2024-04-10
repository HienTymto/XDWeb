@extends('dashboard')

@section('content')

<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Create User</h1>
    <a href="{{ route('user.usermanager') }}" class="btn btn-primary">Back to List</a>
</div>
<hr />
<div class="card">
    <div class="card-body">
    <form action="{{ route('user.user-add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
