<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AgendaModel;

class AgendaController extends Controller
{
    public function index()
    {
        return view('dosenA.agenda.index');
    }

    // public function list(Request $request)
    // {
    //     $agenda = AgendaModel::with('kegiatan')->select('agenda.*'); // Mengambil data agenda beserta kegiatan terkait

    //     return DataTables::of($agenda)
    //         ->addColumn('kegiatan.judul_kegiatan', function($row) {
    //             return $row->kegiatan->judul_kegiatan ?? '-';
    //         })
    //         ->addColumn('upload_berkas', function($row) {
    //             return $row->upload_berkas ?? null;
    //         })
    //         ->rawColumns(['upload_berkas'])
    //         ->make(true);
    // }
}

