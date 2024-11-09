<?php

namespace App\Http\Controllers;

use App\Models\PenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Middleware untuk memastikan pengguna sudah login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman profil
    public function index()
    {
        $pengguna = PenggunaModel::findOrFail(Auth::id());
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => [
                ['name' => 'Home', 'url' => url('/')],
                ['name' => 'Profil', 'url' => url('/profil')]
            ]
        ];
        $activeMenu = 'profil';
        return view('profil', compact('pengguna', 'breadcrumb', 'activeMenu'));
    }

    // Metode untuk update profil pengguna
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|min:3|unique:pengguna,username,' . $id . ',id_pengguna',
            'nama' => 'required|string|max:100',
            'old_password' => 'nullable|string',
            'password' => 'nullable|min:5',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg', // Validasi untuk gambar
        ]);

        // Temukan pengguna berdasarkan id
        $pengguna = PenggunaModel::find($id);

        // Update username dan nama
        $pengguna->username = $request->username;
        $pengguna->nama = $request->nama;

        // Jika pengguna mengisi password lama, periksa validitasnya
        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $pengguna->password)) {
                // Jika password lama valid, update password baru
                $pengguna->password = Hash::make($request->password);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Password lama tidak sesuai')])
                    ->withInput();
            }
        }

        // Jika ada file gambar yang di-upload
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($pengguna->profile_image && Storage::exists('public/photos/' . $pengguna->profile_image)) {
                Storage::delete('public/photos/' . $pengguna->profile_image);
            }
        
            // Simpan gambar baru dan update ke database
            $fileName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/photos', $fileName);
            $pengguna->profile_image = $fileName;
        }
        
        // Simpan perubahan ke database
        $pengguna->save();
        
        // Kembalikan ke halaman profil dengan pesan sukses
        return back()->with('status', 'Profil berhasil diperbarui');
    }

    // Fungsi upload gambar profile yang diakses via ajax
    public function uploadProfileImage(Request $request)
    {
        // Validasi upload file gambar
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengguna = PenggunaModel::find(Auth::id());

        // Hapus gambar lama jika ada
        if ($pengguna->profile_image && Storage::exists('public/photos/' . $pengguna->profile_image)) {
            Storage::delete('public/photos/' . $pengguna->profile_image);
        }

        // Simpan gambar baru
        $fileName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->storeAs('public/photos', $fileName);

        // Update field profile_image pada pengguna
        $pengguna->profile_image = $fileName;
        $pengguna->save();

        // Kembalikan respon JSON
        return response()->json(['success' => true, 'file_name' => $fileName]);
    }
}