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
    public function backup_now(Request $request)
    {
        //validate
        // $request->validate([
        //     'database_name' => 'required',
        //     'database_username' => 'required',
        //     'database_password' => 'required',
        //     'database_host' => 'required',
        //     // 'database_tag' => 'required',
        //     // 'database_description' => 'required',
        // ]);

        //backup the database as SQL script and store it in public path
        $backup_file = public_path('backups/' . $request->database_name . '.sql');
        $command = "mysqldump --user={$request->database_username} --password={$request->database_password} --host={$request->database_host} {$request->database_name} > {$backup_file}";
        $return_var = NULL;
        $output = NULL;
        exec($command, $output, $return_var);

        //redirect
        return back()->with('data',[
            'status' => 'success',
            'message' => 'Backup successful'
        ]);
    }

}
