<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;
use Alert;

class AuthController extends Controller
{
    public function showFormLogin() {
    	if (Auth::check()) {
    		return redirect('/home')->with('sukses', 'Anda Sudah Login');
    	}
    	return view('form_login');
    }

    public function login(Request $request) {
    	$rules = [
    		'username'	=> 'required|string',
    		'password'	=> 'required|string'
    	];

    	$messages = [
    		'username.required'	=> 'Username Harus Diisi',
    		'username.string'	=> 'Username Harus Berupa String',
    		'password.required'	=> 'Password Harus Diisi',
    		'password.string'	=> 'Password Harus Berupa String'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	$data = [
    		'username'	=> $request->input('username'),
    		'password'	=> $request->input('password')
    	];

    	Auth::attempt($data);

    	if (Auth::check()) {
    		// Alert::success('Berhasil', 'Selamat Datang Bro!!!');
            return redirect('/home')->with('sukses', 'Anda Berhasil Login');
 
        } else { 
        	// Session::flash('error', 'Email atau password salah');
            // Alert::error('Gagal', 'Periksa Kembali Email dan Password');
            return redirect()->back()->with('error', 'Periksa Kembali Email dan Password')->withInput($request->all());
        }
    }

    public function logout() {
    	Auth::logout();
    	Session::flush();
    	return redirect('/admin');
    }

    public function showFormRegister()
    {
        return view('form_register');
    }
 
    public function register(Request $request)
    {
        $rules = [
            'nama_alumni'   => 'required|string',
            'username'      => 'required|string|unique:users,username',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed',
            'nim'           => 'required|numeric|min:8'
        ];
 
        $messages = [
            'nama_alumni.required'  => 'Nama Lengkap Harus Diisi',
            'nama_alumni.string'    => 'Nama Lengkap Harus berupa Huruf',
            'username.required'     => 'Username Harus Diisi',
            'username.string'       => 'Username Harus Berupa Huruf',
            'username.unique'       => 'Username Sudah Terpakai',
            'email.required'        => 'Email Harus Diisi',
            'email.email'           => 'Email Tidak Valid',
            'email.unique'          => 'Email Sudah Terdaftar',
            'password.required'     => 'Password Harus Diisi',
            'password.confirmed'    => 'Password Tidak Sama',
            'nim.required'          => 'NIM Harus Diisi',
            'nim.numeric'           => 'NIM Harus Berupa Angka',
            'nim.min'               => 'NIM Minimal 8 Karakter'           
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $user = new User;
        $user->name     = ucwords(strtolower($request->nama_alumni));
        $user->username = strtolower($request->username);
        $user->email    = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->nim      = $request->nim;
        $user->foto_profil = $request->foto_alumni;
        $user->id_status = '2';
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
        // $simpan = TRUE;
        
        if($simpan){
            return response()->json(['pesan' => 'Proses Registrasi Berhasil']);
        }
    }
}
