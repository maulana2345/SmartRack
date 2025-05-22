<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'kelompok',
        'jenis',
        'tgl_kadaluarsa',
        'qty',
        'dimensi',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);  // Menyatakan bahwa Item milik satu Category
    }
}
