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
    </div>
    
</div>

@endsection