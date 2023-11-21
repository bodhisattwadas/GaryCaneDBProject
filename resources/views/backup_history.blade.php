@extends('layout')
@section('page-title')
Backup History
@endsection

@section('main')
{{-- jQuery CDN --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- DataTables CDN --}}
<script>
    // $(document).ready(function() {
    //     $('#mTable').DataTable();
    // });
    //create same database with disabled sort on last column
    $(document).ready(function() {
        $('#mTable').DataTable( {
            "columnDefs": [ {
                "targets": -1,
                "orderable": false
            } ]
        } );
    } );
</script>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Backups</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="ms-auto"><span class="counter text-success">
                    {{-- count total backups --}}
                   {{ $backups->count()  }}
                </span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Manual Backup</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="ms-auto"><span class="counter text-purple">
                    {{-- count backup_mode == Manual --}}
                    {{ $backups->where('backup_mode', 'manual')->count() }}
                </span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Cron Backup</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="ms-auto"><span class="counter text-info">
                    {{ $backups->where('backup_mode', 'cron')->count() }}
                </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card">
    
    <div class="card-header bg-info">
        Backup History
    </div>
    <div class="card-body">
        {{-- Table to list all rows of databasestoragecontroller --}}
        <table id="mTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Database</th>
                    <th>Backup time</th>
                    <th>Backup Type</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                {{-- count --}}
                @php
                $count = 1;
                @endphp
                {{-- loop through all rows of databasestoragecontroller --}}
                @foreach ($backups as $backup)
                <tr>
                    <td   style="font-size: 12px;">{{ $count++ }}</td>
                    @php
                    $database = \App\Models\DatabaseStorage::find($backup->database_id);
                    @endphp
                    <td>
                        <div class="text-danger text-uppercase" style="font-size: 12px;"><b>DB : {{ $database->database_name }}</b></div>
                        <div class="text-info text-uppercase" style="font-size: 10px;">HOST : {{ $database->database_host }}</div>
                    </td>
                    {{-- <td  style="font-size: 12px;">{{ $backup->created_at }}</td> --}}
                    {{-- Change date format --}}
                    <td  style="font-size: 12px;">{{ date('d-m-Y H:i:s a', strtotime($backup->created_at)) }}</td>
                    <td  style="font-size: 12px;">{{ Str::upper($backup->backup_mode) }}</td>
                    {{-- No sort --}}
                    <td >
                        <a href="{{ route('download_backup', $backup->id) }}" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>


@endsection