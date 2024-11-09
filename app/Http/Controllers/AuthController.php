<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaModel; 
use App\Models\PenggunaModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/'); // Redirect to dashboard if already logged in
        }
        return view('auth.login'); // Show login form
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('username', 'password'); // Ensure these fields match your login form

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/dashboard') // Redirect user after successful login
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Login Gagal'
        ], 401); // Added 401 status for failed login
    }
    
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'Anda berhasil logout.'); // Redirect after logout
    }

        public function postregister()
        {
            // Fetch the list of user types from the database
            $jenisPengguna = JenisPenggunaModel::all(); 
            return view('auth.register', compact('jenisPengguna')); // Pass to the view
        }

        public function register(Request $request)
        {
            Log::info('Register request data:', $request->all());
        
            $validator = Validator::make($request->all(), [
                'id_jenis_pengguna' => 'required|integer|exists:jenis_pengguna,id_jenis_pengguna',
                'username' => 'required|string|min:4|max:20|unique:pengguna,username',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100|unique:pengguna,email',
                'password' => 'required|string|min:6',
                'NIP' => 'nullable|string|max:20',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
            }
        
            try {
                PenggunaModel::create([
                    'id_jenis_pengguna' => $request->id_jenis_pengguna,
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'NIP' => $request->NIP,
                ]);
        
                return response()->json([
                    'status' => true,
                    'message' => 'Registrasi berhasil!',
                    'redirect' => url('/login')
                ]);
            } catch (\Exception $e) {
                Log::error('Registration error:', ['error' => $e->getMessage()]);
                return response()->json([
                    'status' => false,
                    'message' => 'Registrasi Gagal: ' . $e->getMessage()
                ], 500);
            }
        }
}
