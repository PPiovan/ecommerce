<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'title' => 'Dashboard Admin',
            'header' => 'Dashboard',
            'subheader' => 'Resumen general del sistema',
        ]);
    }
    public function __construct()
    {
        $this->middleware('permission:dashboard.ver')->only('index');
    }
}