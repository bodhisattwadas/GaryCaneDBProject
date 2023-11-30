<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{

    public function test_connection(Request $request)
    {
        try{
            $connection = mysqli_connect($request->database_host, $request->database_username, $request->database_password, $request->database_name);
            
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
        // select all databases which are due for backup from nextBackUPModel limit by BACKUP_NUMBER less than current time
        $database_ids = \App\Models\NextBackupModel::where('next_backup_time', '<=', date('Y-m-d H:i:s'))->limit(env('BACKUP_NUMBER', 5))->get();
        //Get all database_storages for the above database_ids
        $database_storages = \App\Models\DatabaseStorage::whereIn('id', $database_ids->pluck('database_id'))->get();
        //loop through each database and backup
        foreach($database_storages as $database_storage){
            $database_host = $database_storage->database_host;
            $database_user = $database_storage->database_username;
            $database_pass = $database_storage->database_password;
            $database_name = $database_storage->database_name;
            $database_backup_interval = $database_storage->database_backup_interval;

            $file_name = $database_name.'_backup_'.date('Y-m-d_H-i-s').'.sql';
            // $dir_name = '/home/mpx2m5m5epo2/public_html/backups';
            $dir_name = env('FILE_STORE_PATH','backups');
            //$save_path = 'backups';
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
                //update next_backup_at
                \App\Models\NextBackupModel::where('database_id', $database_storage->id)->update([
                    'next_backup_time' => date('Y-m-d H:i:s', strtotime('+'.$database_backup_interval.' hour'))
                ]);
                //store backup in database
                \App\Models\BackupModel::create([
                    'database_id' => $database_storage->id,
                    'file_path' => $file_path,
                    'backup_mode' => 'cron'
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
