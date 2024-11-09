<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;


class PoinDosenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Pengguna',
            'list' => ['Home', 'Pengguna'],
        ];

        $page = (object)[
            'title' => 'Daftar pengguna yang terdaftar dalam sistem'
        ];
        $activeMenu = 'poindosen';

        return view('admin.poindosen.index', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
