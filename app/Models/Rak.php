<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory;

    // Make sure your model has the $fillable property defined for mass assignment
    protected $fillable = ['kode_rak', 'kapasitas_max', 'kapasitas_tersedia', 'jarak'];
    protected $table = 'racks';  // Pastikan nama tabel sesuai dengan tabel di database
}
