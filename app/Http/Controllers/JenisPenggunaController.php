<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;

class JenisPenggunaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Jenis Pengguna',
            'list' => ['Home', 'jenis pengguna']
        ];
        $page = (object) [
            'title' => 'Daftar jenis pengguna yang terdaftar dalam sistem'
        ];

        $activeMenu = 'jenis_pengguna';
        $jenis_pengguna = JenisPenggunaModel::all();

        // dd($breadcrumb, $page, $jenis_pengguna, $activeMenu);

        return view('admin.jenis_pengguna.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'jenis_pengguna' => $jenis_pengguna,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        // $jenis_pengguna = JenisPenggunaModel::select('id_jenis_pengguna', 'nama_jenis_pengguna', 'bobot', 'jenis_kode', 'created_at', 'updated_at');

        $jenis_pengguna = JenisPenggunaModel::all();

        if ($request->id_jenis_pengguna) {
            $jenis_pengguna->where('id_jenis_pengguna', $request->id_jenis_pengguna);
        }

        return DataTables::of($jenis_pengguna)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jenis_pengguna) {
                $btn = '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenis_pengguna/' . $jenis_pengguna->id_jenis_pengguna . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $jenis_pengguna = JenisPenggunaModel::find($id);
        $page = (object)[
            'title' => 'Detail Jenis Pengguna'
        ];
        return view('admin.jenis_pengguna.show_ajax', ['jenis_pengguna' => $jenis_pengguna, 'page' => $page]);
    }

    public function create_ajax()
    {
        return view('admin.jenis_pengguna.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'jenis_kode' => 'required|string|max:3',
                'nama_jenis_pengguna' => 'required|string|max:100',
                'bobot' => 'required|integer|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                $jenis_pengguna = JenisPenggunaModel::create([
                    'jenis_kode' => $request->jenis_kode,
                    'nama_jenis_pengguna' => $request->nama_jenis_pengguna,
                    'bobot' => $request->bobot
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data jenis pengguna berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $jenis_pengguna = JenisPenggunaModel::find($id);
        if (!$jenis_pengguna) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return view('admin.jenis_pengguna.edit_ajax', ['jenis_pengguna' => $jenis_pengguna]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'jenis_kode' => 'required|string|max:3',
                'nama_jenis_pengguna' => 'required|string|max:100',
                'bobot' => 'required|integer|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                $jenis_pengguna = JenisPenggunaModel::find($id);
                if (!$jenis_pengguna) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                }

                $jenis_pengguna->update([
                    'jenis_kode' => $request->jenis_kode,
                    'nama_jenis_pengguna' => $request->nama_jenis_pengguna,
                    'bobot' => $request->bobot
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data jenis pengguna berhasil diperbarui'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $jenis_pengguna = JenisPenggunaModel::find($id);
        return view('admin.jenis_pengguna.confirm_ajax', ['jenis_pengguna' => $jenis_pengguna]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jenis_pengguna = JenisPenggunaModel::find($id);
            if ($jenis_pengguna) {
                $jenis_pengguna->delete();
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
        }
        return redirect('/');
    }

    public function import(){
        return view('admin.jenis_pengguna.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file' => ['required', 'mimes:xlsx,xls', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'jenis_kode' => $value['A'],
                            'nama_jenis_pengguna' => $value['B'],
                            'bobot' => $value['C'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    JenisPenggunaModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        $jenis_pengguna = JenisPenggunaModel::select('jenis_kode', 'nama_jenis_pengguna', 'bobot')
            ->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Jenis Kode');
        $sheet->setCellValue('C1', 'Nama Jenis Pengguna');
        $sheet->setCellValue('D1', 'Bobot');
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $no = 1;
        $baris = 2;
        foreach ($jenis_pengguna as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->jenis_kode);
            $sheet->setCellValue('C' . $baris, $value->nama_jenis_pengguna);
            $sheet->setCellValue('D' . $baris, $value->bobot);
            $baris++;
            $no++;
        }
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->setTitle('Data Jenis Pengguna');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Jenis Pengguna ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $jenis_pengguna = JenisPenggunaModel::select('id_jenis_pengguna', 'jenis_kode', 'nama_jenis_pengguna', 'bobot')
            ->get();
        $pdf = Pdf::loadView('admin.jenis_pengguna.export_pdf', ['jenis_pengguna' => $jenis_pengguna]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();
        return $pdf->stream('Data Jenis Pengguna ' . date('Y-m-d H:i:s') . '.pdf');
    }
}