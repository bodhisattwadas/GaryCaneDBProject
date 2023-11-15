@extends('layout')
@section('page-title')
Add Database configuration
@endsection
{{-- Generate edit page --}}
@section('main')

<div class="card">
    <div class="card-header bg-info">
        Add Database configuration
    </div>
    <div class="card-body">
        <form action="{{ route('database_storage.store') }}" method="POST">
            @csrf
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
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_host">Database HOST</label>
                        <input type="text" name="database_host" placeholder="database_host" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_name">Database NAME</label>
                        <input type="text" name="database_name" placeholder="database_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_username">Database USER</label>
                        <input type="text" name="database_username" placeholder="database_user" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_password">Database PASSWORD</label>
                        <input type="text" name="database_password" placeholder="database_password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- backup interval select betweel 6 , 12, 24 hours --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_backup_interval">Backup Interval</label>
                        <select name="database_backup_interval" class="form-control">
                            <option value="6">6 Hours</option>
                            <option value="12">12 Hours</option>
                            <option value="24" selected>24 Hours</option>
                        </select>
                    </div>
                </div>
            </div>
                
                
                
                
                {{-- backup interval select betweel 6 , 12, 24 hours --}}
                
                {{-- database_tag --}}
                <div class="form-group">
                    <label for="name">Database TAG [OPTIONAL]</label>
                    <input type="text" name="database_tag" placeholder="database_tag" class="form-control">
                </div>
                {{-- database_description --}}
                <div class="form-group">
                    <label for="name">Database DESCRIPTION  [OPTIONAL]</label>
                    <input type="text" name="database_description" placeholder="database_description" class="form-control">
                </div>
                <!-- submit button -->
                <a href="{{ route('database_storage.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Database</button>
            </form>
    </div>
</div>
@endsection