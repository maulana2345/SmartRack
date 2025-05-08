<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return view('aktivitas.index', [
                'title' => 'Log Aktivitas',
            ]
        );
    }
}
