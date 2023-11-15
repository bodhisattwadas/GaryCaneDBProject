@extends('layout')
@section('page-title')
Edit Database configuration
@endsection
{{-- Generate edit page --}}

@section('main')
{{-- Generate edit page --}}
<div class="card">
    <div class="card-header bg-info">
        Edit Database configuration
    </div>
    <div class="card-body">
        {{-- <form action="{{ route('database_storage.update') }}" method="POST"> --}}
        <form action="{{ route('database_storage.update', $database_storage->id) }}" method="POST">
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
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Database HOST</label>
                        <input type="text" name="database_host" placeholder="database_host" class="form-control" value="{{ $database_storage->database_host }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Database NAME</label>
                        <input type="text" name="database_name" placeholder="database_name" class="form-control" value="{{ $database_storage->database_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Database USER</label>
                        <input type="text" name="database_username" placeholder="database_user" class="form-control" value="{{ $database_storage->database_username }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Database PASSWORD</label>
                        <input type="password" name="database_password" placeholder="database_password" class="form-control" value="{{ $database_storage->database_password }}">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- backup interval select betweel 6 , 12, 24 hours --}}
                        <label for="database_backup_interval">Backup Interval</label>
                        <select name="database_backup_interval" class="form-control">
                            <option value="6" {{ $database_storage->database_backup_interval == 6 ? 'selected' : '' }}>6 Hours</option>
                            <option value="12" {{ $database_storage->database_backup_interval == 12 ? 'selected' : '' }}>12 Hours</option>
                            <option value="18" {{ $database_storage->database_backup_interval == 18 ? 'selected' : '' }}>18 Hours</option>
                            <option value="24" {{ $database_storage->database_backup_interval == 24 ? 'selected' : '' }}>24 Hours</option>
                        </select>
                </div>
                
            </div>
            </div>
            
            {{-- database_tag --}}
            <div class="form-group">
                <label for="name">Database TAG [OPTIONAL]</label>
                <input type="text" name="database_tag" placeholder="database_tag" class="form-control" value="{{ $database_storage->database_tag }}">
            </div>
            {{-- database_description --}}
            <div class="form-group">
                <label for="name">Database DESCRIPTION  [OPTIONAL]</label>
                <input type="text" name="database_description" placeholder="database_description" class="form-control" value="{{ $database_storage->database_description }}">
            </div>
            
            
            <a href="{{ route('database_storage.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
        </form>
    </div>
</div>
@endsection