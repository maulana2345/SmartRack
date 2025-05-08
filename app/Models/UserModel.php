<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user'; // Sesuai migration kamu

    protected $fillable = [
        'nama_pengguna',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password'];
}
