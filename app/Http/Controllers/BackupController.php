<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{

    public function test_connection(Request $request)
    {
        try{
            $connection = @mysqli_connect($request->database_host, $request->database_username, $request->database_password, $request->database_name);
            
            return back()->with('data',[
                'status' => 'success',
                'message' => 'Connection successful'
            ]);
        }catch(\Exception $e){
            return back()->with('data',[
                'status' => 'error',
                'message' => 'Connection failed: ' . $e->getMessage()
            ]);
        }
    }
    //backup_now
    public function backup_now(Request $request){
        $database_host = $request->database_host;
        $database_user = $request->database_username;
        $database_pass = $request->database_password;
        $database_name = $request->database_name;
        

        $file_name = $database_name.'_backup_'.date('Y-m-d_H-i-s').'.sql';
        $dir_name = 'backups';
        $file_path = $dir_name.'/'.$file_name; 
        //connect and backup the database and store it in the backup folder
        try{
            $conn = new \PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //Change mysqldump path after server migration
            //GET MYSQLDUMP PATH FROM ENV
            $command = env('MYSQLDUMP_PATH')." -h $database_host -u $database_user -p$database_pass $database_name > $file_path";
            \Log::info($command);
            exec($command);
            \App\Models\BackupModel::create([
                'database_id' => $request->database_id,
                'file_path' => $file_path,
                'backup_mode' => 'manual',
            ]);
            return back()->with('data',[
                        'status' => 'success',
                        'message' => 'Backup successful'
            ]);
            // echo "Database backed up successfully to the backups folder";
        }catch(\PDOException $e){
            return back()->with('data',[
                        'status' => 'error',
                        'message' => 'Backup failed: ' . $e->getMessage()
            ]);
        }
        
    }
    
    //backup_cron
    public function _cronBackup(){
        //Get list of all databases
        $database_storages = \DB::select('SELECT ds.*
        FROM database_storages ds
        LEFT JOIN backup_models bm ON ds.id = bm.database_id
        LEFT JOIN (
            SELECT database_id, next_backup_at
            FROM backup_models
            WHERE backup_mode = \'cron\'
            AND next_backup_at <= CURRENT_TIMESTAMP
            AND next_backup_at IS NOT NULL
        ) AS bm_cron ON ds.id = bm_cron.database_id
        WHERE bm.database_id IS NULL OR bm_cron.database_id IS NOT NULL
        ORDER BY bm_cron.next_backup_at ASC
        LIMIT ?;', [env('BACKUP_NUMBER', 5)]);   
        //Iterate through each database and backup

        foreach($database_storages as $database_storage){
            $database_host = $database_storage->database_host;
            $database_user = $database_storage->database_username;
            $database_pass = $database_storage->database_password;
            $database_name = $database_storage->database_name;
            $database_backup_interval = $database_storage->database_backup_interval;

            $file_name = $database_name.'_backup_'.date('Y-m-d_H-i-s').'.sql';
            $dir_name = 'backups';
            $file_path = $dir_name.'/'.$file_name;
            
            //GET MYSQLDUMP PATH FROM ENV
            //connect and backup the database and store it in the backup folder
            try{
                $conn = new \PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                //Change mysqldump path after server migration
                $command = env('MYSQLDUMP_PATH','mysqldump')." -h $database_host -u $database_user -p$database_pass $database_name > $file_path";
                \Log::info($command);
                exec($command);
                //update all backups for this database to next backup time as NULL
                \App\Models\BackupModel::where('database_id', $database_storage->id)->update([
                    'next_backup_at' => NULL
                ]);
                //store backup in database
                \App\Models\BackupModel::create([
                    'database_id' => $database_storage->id,
                    'file_path' => $file_path,
                    'backup_mode' => 'cron',
                    'next_backup_at' => date('Y-m-d H:i:s', strtotime('+'.$database_backup_interval.' hour'))
                ]);
                \Log::debug($database_name." Database backed up successfully to the backups folder at : ".date('Y-m-d H:i:s'));
            }catch(\PDOException $e){
                \Log::info($e->getMessage());
            }
        }
        
    }
    public function download_backup($backup_id){
        $backup = \App\Models\BackupModel::find($backup_id);
        $file_path = $backup->file_path;
        return response()->download($file_path);
    }
    public function backup_history($database_id){
        $backups = \App\Models\BackupModel::where('database_id', $database_id)->get();
        return view('backup_history', [
            'backups' => $backups
        ]);
    }
    //backup_history_all
    public function backup_history_all(){
        //Onbly the backups which exists in storage table
        $backups = \App\Models\BackupModel::all();
        //select only those whole database_id exists in database_storages table
        $backups = $backups->filter(function($backup){
            return \App\Models\DatabaseStorage::where('id', $backup->database_id)->exists();
        });
        
        return view('backup_history', [
            'backups' => $backups
        ]);
    }



}
