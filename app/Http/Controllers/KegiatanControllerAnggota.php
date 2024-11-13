<?php

namespace App\Http\Controllers;


use App\Models\KegiatanModel;
use App\Models\PenggunaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanControllerAnggota extends Controller
{
    // Menampilkan halaman daftar kegiatan
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kegiatan',
            'list' => ['Home', 'Kegiatan'],
        ];


        $pengguna = PenggunaModel::all(); // Ambil data pengguna untuk pilihan PIC jika diperlukan


        $activeMenu = 'kegiatan';
        return view('dosenA.kegiatan.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'pengguna' => $pengguna]);
    }

    // Mengambil data kegiatan untuk DataTable
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = KegiatanModel::with(['pic'])->get(); // Mengambil data kegiatan beserta relasi PIC

            return DataTables::of($data)
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="' . route('kegiatan.edit', $row->id_kegiatan) . '" class="edit btn btn-sm btn-primary">Edit</a>';
                    $btn .= ' <a href="' . route('kegiatan.destroy', $row->id_kegiatan) . '" class="delete btn btn-sm btn-danger" onclick="return confirm(\'Hapus kegiatan ini?\')">Delete</a>';
                    return $btn;
                })
                ->addColumn('surat_tugas', function ($row) {
                    return $row->dokumen ? asset('storage/' . $row->dokumen->draft_surat_tugas) : null;
                })
                ->editColumn('status', function ($row) {
                    return ucfirst($row->status);
                })
                ->editColumn('poin_kegiatan', function ($row) {
                    return $row->poin_kegiatan . ' Poin';
                })
                ->editColumn('tanggal_mulai', function ($row) {
                    return $row->tanggal_mulai->format('d M Y');
                })
                ->editColumn('tanggal_selesai', function ($row) {
                    return $row->tanggal_selesai->format('d M Y');
                })
                ->make(true);
        }
    }

    // Fungsi untuk menyimpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'pic_id' => 'required|exists:pengguna,id_pengguna',
            'status' => 'required|string|max:50',
            'poin_kegiatan' => 'required|integer',
        ]);

        $kegiatan = new KegiatanModel();
        $kegiatan->judul_kegiatan = $request->judul_kegiatan;
        $kegiatan->tanggal_mulai = $request->tanggal_mulai;
        $kegiatan->tanggal_selesai = $request->tanggal_selesai;
        $kegiatan->pic_id = $request->pic_id;
        $kegiatan->status = $request->status;
        $kegiatan->poin_kegiatan = $request->poin_kegiatan;

        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas')->store('surat_tugas', 'public');
            $kegiatan->dokumen()->create(['draft_surat_tugas' => $file]);
        }

        $kegiatan->save();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // Fungsi untuk mengedit kegiatan
    public function edit($id)
    {
        $kegiatan = KegiatanModel::findOrFail($id);
        $pengguna = PenggunaModel::all();
        return view('kegiatan.edit', compact('kegiatan', 'pengguna'));
    }

    // Fungsi untuk update data kegiatan
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'pic_id' => 'required|exists:pengguna,id_pengguna',
            'status' => 'required|string|max:50',
            'poin_kegiatan' => 'required|integer',
        ]);

        $kegiatan = KegiatanModel::findOrFail($id);
        $kegiatan->judul_kegiatan = $request->judul_kegiatan;
        $kegiatan->tanggal_mulai = $request->tanggal_mulai;
        $kegiatan->tanggal_selesai = $request->tanggal_selesai;
        $kegiatan->pic_id = $request->pic_id;
        $kegiatan->status = $request->status;
        $kegiatan->poin_kegiatan = $request->poin_kegiatan;

        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas')->store('surat_tugas', 'public');
            $kegiatan->dokumen()->updateOrCreate([], ['draft_surat_tugas' => $file]);
        }

        $kegiatan->save();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // Fungsi untuk menghapus kegiatan
    public function destroy($id)
    {
        $kegiatan = KegiatanModel::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
