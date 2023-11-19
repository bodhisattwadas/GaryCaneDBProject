@extends('layout')
@section('page-title')
Database
@endsection
{{-- Generate index page --}}
@section('main')
<style>
    h5{
        font-weight: bold;
        color: brown;
    }
</style>
@if(session()->has('data') && session()->get('data')['status'] == 'error')
                <div class="alert alert-danger">
                    {{ session()->get('data')['message'] }}
                </div>
@elseif(session()->has('data') && session()->get('data')['status'] == 'success')
                {{-- success --}}
                <div class="alert alert-success">
                    {{ session()->get('data')['message'] }}
                </div>
@endif
<div class="card">
    <div class="card-header bg-info">
        Database: <b>{{ $database_storage->database_name }}</b> [HOST : <b>{{ $database_storage->database_host }}</b>]
    </div>
    <div class="card-body">
        <div class="row">
            <h4>Database Name :</h4> <h5>{{ $database_storage->database_name }}</h5>
            <h4>Database Host :</h4> <h5>{{ $database_storage->database_host }}</h5>
            <h4>Database User :</h4> <h5>{{ $database_storage->database_username }}</h5>
            <h4>Database Password :</h4> <h5>{{ $database_storage->database_password }}</h5>
            <h4>Backup Interval :</h4> <h5>{{ $database_storage->database_backup_interval }} HOURS</h5>
            <h4>Tag : </h4><h5>{{ $database_storage->database_tag }}</h5>
            <h4>Description :</h4><h5>{{ $database_storage->database_description }}</h5>
            <h4>Created at :</h4> <h5>{{ $database_storage->created_at->format('d/m/Y h:i a') }}</h5>
            <h4>Updated at :</h4> <h5>{{ $database_storage->updated_at->format('d/m/Y h:i a') }}</h5>

        </div>
        <a href="{{ route('database_storage.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
        <a href="{{ route('database_storage.edit', $database_storage->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
        <form action="{{ route('database_storage.destroy', $database_storage->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
        </form>
        
        <br>
        <br>
        {{-- test connection button --}}
        <form action="{{ route('test_connection', $database_storage->id) }}" method="POST" style="display: inline-block;">
            @csrf
            {{-- error --}}
            <input type="hidden" name="database_id" value="{{ $database_storage->id }}">
            <input type="hidden" name="database_name" value="{{ $database_storage->database_name }}">
            <input type="hidden" name="database_host" value="{{ $database_storage->database_host }}">
            <input type="hidden" name="database_username" value="{{ $database_storage->database_username }}">
            <input type="hidden" name="database_password" value="{{ $database_storage->database_password }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Test Connection</button>
        </form>
        {{-- <a href="{{ route('database_storage.test_connection', $database_storage->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Test Connection</a> --}}
        {{-- delete button --}}
        
        {{-- backup now button --}}
        {{-- <a href="{{ route('backup_now', $database_storage->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Backup Now</a> --}}
        {{-- restore button --}}
        {{-- ?backup now form --}}
        <form action="{{ route('backup_now', $database_storage->id) }}" method="POST" style="display: inline-block;">
            @csrf
            {{-- error --}}
            <input type="hidden" name="database_id" value="{{ $database_storage->id }}">
            <input type="hidden" name="database_name" value="{{ $database_storage->database_name }}">
            <input type="hidden" name="database_host" value="{{ $database_storage->database_host }}">
            <input type="hidden" name="database_username" value="{{ $database_storage->database_username }}">
            <input type="hidden" name="database_password" value="{{ $database_storage->database_password }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Backup Now</button>
        </form>
    </div>
    
</div>

@endsection