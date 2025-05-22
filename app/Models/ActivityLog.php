<?php

// app/Models/ActivityLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'storage_details';

    protected $fillable = [
        'item_id',
        'jumlah',
        'rack_id',
        'tgl_masuk',
        'tgl_keluar',
    ];

}

