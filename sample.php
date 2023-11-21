<?php
$database_host = '162.241.123.152';
$database_user = 'a1624qmr_admission';
$database_pass = 'irishHNGF_1984';
$database_name = 'a1624qmr_admission';

$file_name = $database_name.'_backup_'.date('Y-m-d_H-i-s').'.sql';
$dir_name = 'backups';
$file_path = $dir_name.'/'.$file_name; 
//connect and backup the database and store it in the backup folder
try{
    $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $command = "C:\\xampp\\mysql\\bin\\mysqldump.exe -h $database_host -u $database_user -p$database_pass $database_name > $file_path";
    exec($command);
    echo "Database backed up successfully to the backups folder";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    
}
// $command = "mysqldump -h $database_host -u $database_user -p$database_pass $database_name > backups/$file_name";
// exec($command);
?>