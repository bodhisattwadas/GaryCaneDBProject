<?php

namespace App\Http\Controllers;

use App\Models\DatabaseStorage;
use Illuminate\Http\Request;

class DatabaseStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('index', [
            'database_storages' => DatabaseStorage::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'database_name' => 'required',
            'database_username' => 'required',
            'database_password' => 'required',
            'database_host' => 'required',
            // 'database_tag' => 'required',
            // 'database_description' => 'required',
        ]);
       
        //store
        DatabaseStorage::create([
            'database_name' => $request->database_name,
            'database_username' => $request->database_username,
            'database_password' => $request->database_password,
            'database_host' => $request->database_host,
            'database_tag' => $request->database_tag,
            'database_description' => $request->database_description,
            'database_backup_interval' => $request->database_backup_interval,
        ]);

        //redirect
        return redirect()->route('database_storage.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatabaseStorage $databaseStorage)
    {
        //
        return view('show', [
            'database_storage' => $databaseStorage
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatabaseStorage $databaseStorage)
    {
        //
        return view('edit', [
            'database_storage' => $databaseStorage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatabaseStorage $databaseStorage)
    {
        //
        //validate
        $request->validate([
            'database_name' => 'required',
            'database_username' => 'required',
            'database_password' => 'required',
            'database_host' => 'required',
        ]);

        //update
        $databaseStorage->update([
            'database_name' => $request->database_name,
            'database_username' => $request->database_username,
            'database_password' => $request->database_password,
            'database_host' => $request->database_host,
            'database_tag' => $request->database_tag,
            'database_description' => $request->database_description,
            'database_backup_interval' => $request->database_backup_interval,
        ]);

        //redirect
        return redirect()->route('database_storage.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatabaseStorage $databaseStorage)
    {
        //
        //delete resource
        $databaseStorage->delete();
        //delete backups
        \App\Models\BackupModel::where('database_id', $databaseStorage->id)->delete();
        return redirect()->route('database_storage.index');

    }
    // private function _getIntervalCount(Request $request){
    //     $database_backup_interval_count = 1;
    //     if($request->database_backup_interval == 24){
    //         $database_backup_interval_count = 1;
    //     }elseif($request->database_backup_interval == 12){
    //         $database_backup_interval_count = 2;
    //     }elseif($request->database_backup_interval == 8){
    //         $database_backup_interval_count = 3;
    //     }elseif($request->database_backup_interval == 6){
    //         $database_backup_interval_count = 4;
    //     }
    //     return $database_backup_interval_count;
    // }
    
}
