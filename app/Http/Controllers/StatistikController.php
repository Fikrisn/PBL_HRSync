<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik'],
        ];

        $page = (object)[
            'title' => 'Daftar pengguna dan kegiatan'
        ];
        $activeMenu = 'statistik';

        return view('admin.statistik.index', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);

    }
}