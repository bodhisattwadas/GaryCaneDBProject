<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseStorage extends Model
{
    use HasFactory;
    protected $fillable = [
        'database_name',
        'database_username',
        'database_password',
        'database_host',
        'database_tag',
        'database_description',
        'database_backup_interval',
        'database_backup_interval_count',
    ];
}
