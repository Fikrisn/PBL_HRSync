<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanControllerPIC extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kegiatan',
            'list' => ['Home', 'Kegiatan'],
        ];

        $activeMenu = 'kegiatan';
        return view('dosenP.kegiatan.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
