<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoinControllerAnggota extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Poin Dosen Anggota',
            'list' => ['Home', 'Poin Dosen'],
        ];

        $page = (object)[
            'title' => 'Daftar Poin Dosen Anggota dalam sistem'
        ];
        $activeMenu = 'poinku';

        return view('dosenA.poinku.index', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
