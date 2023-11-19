@extends('layout')
@section('page-title')
Edit Profile Details
@endsection

{{-- Generate index page --}}
@section('main')
<div class="card">
    <div class="card-header bg-info">
        Change Profile Details
    </div>
    <div class="card-body">
    <form action="{{ route('profile.update',$user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        {{-- handle error message --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input. <br><br>
            {{-- show error message --}}
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                {{-- end show error message --}}
            </ul>
        </div>
        {{-- if success --}}
        @elseif(session('success'))
            <div class="alert alert-success">
                <strong>Password changed successfully!!!</strong>
            </div>
        @endif
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        {{-- <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
        </div> --}}

        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
    </div>
</div>
@endsection