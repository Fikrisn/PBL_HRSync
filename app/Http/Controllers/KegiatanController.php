<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use App\Models\JenisKegiatanModel;
use App\Models\PenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class KegiatanController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Kegiatan',
            'list'=>['Home','Kegiatan']
        ];
        $page = (object)[
            'title'=>'Daftar kegiatan yang terdaftar dalam sistem '
        ];
        $activeMenu ='kegiatan';
        $kegiatan = KegiatanModel::all();
        return view('admin.kegiatan.index', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function list(Request $request)
    {
        $kegiatan = KegiatanModel::with(['jenisKegiatan', 'pic', 'anggota'])
            ->select('id_kegiatan', 'judul_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'id_jenis_kegiatan', 'pic_id');

        if ($request->id_kegiatan) {
            $kegiatan->where('id_kegiatan', $request->id_kegiatan);
        }

        return DataTables::of($kegiatan)
            ->addIndexColumn()
            ->addColumn('nama_jenis_kegiatan', function ($kegiatan) {
                return $kegiatan->jenisKegiatan->nama_jenis_kegiatan;
            })
            ->addColumn('pic', function ($kegiatan) {
                return $kegiatan->pic->nama ?? 'Tidak ada PIC';
            })
            ->addColumn('anggota', function ($kegiatan) {
                return $kegiatan->anggota->pluck('nama')->implode(', ');
            })
            ->addColumn('aksi', function ($kegiatan) {
                $btn = '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatan/' . $kegiatan->id_kegiatan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $jenis_kegiatan = JenisKegiatanModel::select('id_jenis_kegiatan', 'nama_jenis_kegiatan')->get();
        $pengguna = PenggunaModel::select('id_pengguna', 'nama')->get();
        return view('admin.kegiatan.create_ajax', ['jenis_kegiatan' => $jenis_kegiatan, 'pengguna' => $pengguna]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'judul_kegiatan' => 'required|string|max:100',
                'deskripsi_kegiatan' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'id_jenis_kegiatan' => 'required|integer',
                'pic_id' => 'required|integer|exists:pengguna,id',
                'anggota_id' => 'required|array|min:1|max:6|exists:pengguna,id',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
    
            $kegiatan = KegiatanModel::create([
                'judul_kegiatan' => $request->judul_kegiatan,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
                'pic_id' => $request->pic_id
            ]);
    
            $anggotaIds = $request->anggota_id;
    
            foreach ($anggotaIds as $anggotaId) {
                $kegiatan->anggota()->attach($anggotaId);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'Data kegiatan berhasil disimpan'
            ]);
        }
    }
    
    public function show(string $id_kegiatan){
        $kegiatan = KegiatanModel::find($id_kegiatan);
        $breadcrumb = (object)[
            'title'=>'Detail Kegiatan',
            'list'=>['Home','Kegiatan','Detail']
        ];
        $page = (object)[
            'title'=>'Detail kegiatan'
        ];
        $activeMenu = 'kegiatan';
        return view('admin.kegiatan.show', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function show_ajax($id)
    {
        $kegiatan = KegiatanModel::with(['jenisKegiatan', 'pic', 'anggota'])->find($id);

        if (!$kegiatan) {
            return view('admin.kegiatan.show_ajax')->with('kegiatan', null);
        }

        return view('admin.kegiatan.show_ajax', compact('kegiatan'));
    }

    public function edit(string $id_kegiatan){
        $kegiatan = KegiatanModel::find($id_kegiatan);

        $breadcrumb = (object)[
            'title'=>'Edit Kegiatan',
            'list'=>['Home','Kegiatan','Edit']
        ];
        $page = (object)[
            'title'=>'Edit kegiatan'
        ];
        $activeMenu = 'kegiatan';
        return view('admin.kegiatan.edit', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'activeMenu'=>$activeMenu, 'kegiatan'=>$kegiatan]);
    }

    public function update(Request $request, string $id_kegiatan){
        $request->validate([
            'judul_kegiatan' => 'required|string|max:100',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_jenis_kegiatan' => 'required|integer',
            'id_dokumen' => 'required|integer',
            'jenis_pengguna' => 'required|string',
            'nama' => 'required|string|max:100',
            'id_pengguna' => 'required|integer'
        ]);
        $kegiatan = KegiatanModel::find($id_kegiatan);
        $kegiatan->update([
            'judul_kegiatan' => $request->judul_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
            'id_dokumen' => $request->id_dokumen,
            'jenis_pengguna' => $request->jenis_pengguna,
            'nama' => $request->nama,
            'id_pengguna' => $request->id_pengguna
        ]);
        return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil diperbarui');
    }

    public function edit_ajax($id)
    {
        $kegiatan = KegiatanModel::find($id);
        $jenis_kegiatan = JenisKegiatanModel::all();
        $pic = PenggunaModel::all();

        if (!$kegiatan) {
            return view('admin.kegiatan.edit_ajax')->with('kegiatan', null);
        }

        return view('admin.kegiatan.edit_ajax', compact('kegiatan', 'jenis_kegiatan', 'pic'));
    }

    public function update_ajax(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'id_jenis_kegiatan' => 'required|exists:jenis_kegiatan,id_jenis_kegiatan',
            'pic_id' => 'required|exists:users,id',
        ]);

        $kegiatan = KegiatanModel::find($id);
        $kegiatan->judul_kegiatan = $validatedData['judul_kegiatan'];
        $kegiatan->deskripsi_kegiatan = $validatedData['deskripsi_kegiatan'];
        $kegiatan->tanggal_mulai = $validatedData['tanggal_mulai'];
        $kegiatan->tanggal_selesai = $validatedData['tanggal_selesai'];
        $kegiatan->id_jenis_kegiatan = $validatedData['id_jenis_kegiatan'];
        $kegiatan->pic_id = $validatedData['pic_id'];
        $kegiatan->save();

        return response()->json(['success' => 'Kegiatan berhasil diperbarui']);
    }

    public function destroy(string $id_kegiatan){
        $check = KegiatanModel::find($id_kegiatan);
        if (!$check) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }
        try {
            KegiatanModel::destroy($id_kegiatan);
            return redirect('/kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kegiatan')->with('error', 'Data kegiatan gagal dihapus karena masih terkait dengan data lain');
        }
    }

    public function confirm_ajax(string $id) {
        $kegiatan = KegiatanModel::find($id);
        return view('admin.kegiatan.confirm_ajax', ['kegiatan' => $kegiatan]);
    }

    public function delete_ajax(Request $request, string $id) {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $check = KegiatanModel::find($id);
                if ($check) {
                    KegiatanModel::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kegiatan gagal dihapus karena masih terkait dengan data lain'
                ]);
            }
        }
        return redirect('/');
    }
    
    public function events()
    {
        // Ambil semua data kegiatan dari database
        $kegiatans = KegiatanModel::all();

        // Ubah data kegiatan ke format yang dibutuhkan FullCalendar
        $events = $kegiatans->map(function ($kegiatan) {
            return [
                'title' => $kegiatan->judul_kegiatan,           // Judul kegiatan sebagai judul event
                'start' => $kegiatan->tanggal_mulai,            // Tanggal mulai kegiatan
                'end' => $kegiatan->tanggal_selesai,            // Tanggal selesai kegiatan
                'description' => $kegiatan->deskripsi_kegiatan, // Deskripsi kegiatan (opsional)
                'id' => $kegiatan->id                           // ID kegiatan (opsional, untuk kebutuhan lain)
            ];
        });

        // Kembalikan data dalam bentuk JSON
        return response()->json($events);
    }
}