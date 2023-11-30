<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextBackupModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'database_id',
        'next_backup_time',
    ];
}
