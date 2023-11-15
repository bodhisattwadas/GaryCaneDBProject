@extends('layout')
@section('page-title')
Home
@endsection

@section('main')
<div class="row">
    <div class="col-md-6">
        {{-- <a class="btn btn-primary" href="{{ route('database_storage.create') }}"> Add database</a> --}}
        
        <a class="btn btn-primary" href="{{ route('database_storage.create') }}"><i class="fa fa-plus"></i> Add
            database</a>
    </div>

    
</div>
<br>
<div class="card">
    
    <div class="card-header bg-info">
        List of Database
    </div>
    <div class="card-body">
        {{-- Table to list all rows of databasestoragecontroller --}}
        <table class="table table-bordered" id="mTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HOST</th>
                    <th>Database NAME</th>
                    <th>Database USER</th>
                    {{-- <th>PASSWORD</th> --}}
                    <th>TAG</th>
                    <th>DESCRIPTION</th>
                    {{-- <th>Added On</th>
                    <th>Updated On</th> --}}
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- count --}}
                @php
                $count = 1;
                @endphp
                {{-- loop through all rows of databasestoragecontroller --}}
                @foreach ($database_storages as $database)
                <tr>
                    {{-- <td>{{ $database->id }}</td> --}}
                    {{-- count --}}
                    <td>{{ $count++ }}</td>
                    <td>{{ $database->database_host }}</td>
                    <td>{{ $database->database_name }}</td>
                    <td>{{ $database->database_username }}</td>
                    {{-- <td>{{ $database->database_password }}</td> --}}
                    <td>{{ $database->database_tag }}</td>
                    <td>{{ $database->database_description }}</td>
                    {{-- show resource --}}
                    <td>
                        <div><a href="{{ route('database_storage.show', $database->id) }}" class="btn btn-success"><i
                            class="fa fa-eye"></i></a></div>
                        <div>
                    </td>
                    <td>
                        <div><a href="{{ route('database_storage.edit', $database->id) }}" class="btn btn-primary"><i
                            class="fa fa-edit"></i></a></div>
                        <div>
                    </td>
                    <td>
                            <form action="{{ route('database_storage.destroy', $database->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this database?');"><i
                                    class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>


@endsection