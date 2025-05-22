<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Menambahkan relasi hasMany ke Item
    public function items()
    {
        return $this->hasMany(Item::class);  // Menyatakan bahwa Category bisa memiliki banyak Item
    }
}
