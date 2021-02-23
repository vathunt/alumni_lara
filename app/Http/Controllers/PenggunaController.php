<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Alumni;
use Validator;
use Session;
use Hash;
use Carbon\Carbon;
use File;
use Image;

class PenggunaController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        //Path
        $this->path = public_path('/images/users');
        //Dimensi
        $this->dimensions = ['180', '240'];
    }

    public function index() {
     //    $user = User::all();
    	// return view('admin.pengguna', ['data' => $user]);
        return view('admin.pengguna');
    }

    public function simpan(Request $request) {
        $rules = [
            'nama'          => 'required|string',
            'username'      => 'required|string|unique:users,username',
            'status'        => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed',
            'foto_profil'   => 'image|mimes:jpg,png,jpeg|file|max:2048'
        ];
 
        $messages = [
            'nama.required'     => 'Nama Lengkap Harus Diisi',
            'name.string'       => 'Nama Lengkap Harus Berupa String',
            'username.required' => 'Username Harus Diisi',
            'username.string'   => 'Username Harus Berupa String',
            'username.unique'   => 'Username Sudah Terpakai',
            'status.required'   => 'Status Harus Dipilih',
            'email.required'    => 'Email Harus Diisi',
            'email.email'       => 'Email Tidak Valid',
            'email.unique'      => 'Email Sudah Terdaftar',
            'password.required' => 'Password Harus Diisi',
            'password.confirmed'=> 'Password Tidak Sama',
            'foto_profil.image' => 'Foto Profil Harus Berbentuk File Gambar',
            'foto_profil.mimes' => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'foto_profil.max'  => 'Ukuran File Tidak Boleh Lebih dari 2 MB'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        // Buat Folder Jika Belum Ada
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0777, true, true);
        }

        $file_foto = $request->file('foto_profil');
        if ($file_foto) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_foto->getClientOriginalExtension();
            Image::make($file_foto)->save($this->path . '/' . $fileName);

            foreach ($this->dimensions as $row) {
                $canvas = Image::canvas($row, $row);
                $resizeImage = Image::make($file_foto)->resize($row, $row, function($constraint) {
                        $constraint->aspectRatio();
                    });

                if (!File::isDirectory($this->path . '/' . $row)) {
                    File::makeDirectory($this->path . '/' . $row, 0777, true, true);
                }

                $canvas->insert($resizeImage, 'center');
                $canvas->save($this->path . '/' . $row . '/' . $fileName);
            }
        } else {
            $fileName = '';
        }
         
        $user = new User;
        $user->name = ucwords(strtolower($request->nama));
        $user->username = strtolower($request->username);
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->id_status = $request->status;
        $user->foto_profil = $fileName;
        $simpan = $user->save();
 
        if($simpan){
            return redirect('/pengguna')->with('sukses', 'Data Pengguna Berhasil Disimpan');
        } else {
            return redirect('/pengguna')->with('error', 'Data Pengguna Gagal Disimpan');
        }
    }

    public function destroy(Request $request){
        $id = $request->id;
        $pengguna = User::find($id);
        // return $this->path . '/'. $pengguna->foto_profil;

        // Hapus Foto dan Thumbnail di Direktori
        File::delete($this->path . '/'. $pengguna->foto_profil);
        foreach ($this->dimensions as $row) {
            File::delete($this->path . '/' . $row . '/' . $pengguna->foto_profil);
        }
        // Akhir Hapus Foto dan Thumbnail

        $pengguna->delete();
        return redirect('/pengguna')->with('sukses', 'Data Pengguna Berhasil Dihapus');
        // return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Dihapus', 'cat' => 'warning']);
    }

    public function edit($id){
        $pengguna = User::find(Crypt::decrypt($id));
        return response()->json($pengguna);
    }

    public function update(Request $request) {
        $id = $request->idEdit;
        
        $this->validate($request, [
            'nama'          => 'required|string',
            'username'      => ['required', 'string', Rule::unique('users')->ignore($id)],
            'status'        => 'required',
            'email'         => ['required', 'email', Rule::unique('users')->ignore($id),],
            'foto_profil'   => 'image|mimes:jpg,png,jpeg|file|max:2048'
        ],[
            'nama.required'     => 'Nama Lengkap Harus Diisi',
            'name.string'       => 'Nama Lengkap Harus Berupa String',
            'username.required' => 'Username Lengkap Harus Diisi',
            'username.string'   => 'Username Lengkap Harus Berupa String',
            'username.unique'   => 'Username Sudah Terpakai',
            'status.required'   => 'Status Harus Dipilih',
            'email.required'    => 'Email Harus Diisi',
            'email.email'       => 'Email Tidak Valid',
            'email.unique'      => 'Email Sudah Terdaftar',
            'foto_profil.image' => 'Foto Profil Harus Berbentuk File Gambar',
            'foto_profil.mimes' => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'foto_profil.max'  => 'Ukuran File Tidak Boleh Lebih dari 2 MB'
        ]);

        $file_foto = $request->file('foto_profil');
        if ($file_foto) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_foto->getClientOriginalExtension();
            Image::make($file_foto)->save($this->path . '/' . $fileName);

            foreach ($this->dimensions as $row) {
                $canvas = Image::canvas($row, $row);
                $resizeImage = Image::make($file_foto)->resize($row, $row, function($constraint) {
                        $constraint->aspectRatio();
                    });

                if (!File::isDirectory($this->path . '/' . $row)) {
                    File::makeDirectory($this->path . '/' . $row, 0777, true, true);
                }

                $canvas->insert($resizeImage, 'center');
                $canvas->save($this->path . '/' . $row . '/' . $fileName);
            }
        }

        // return $id;
        $user = User::find($id);

        if ($file_foto) {
            // Hapus Foto dan Thumbnail di Direktori
            File::delete($this->path . '/'. $user->foto_profil);
            foreach ($this->dimensions as $row) {
                File::delete($this->path . '/' . $row . '/' . $user->foto_profil);
            }
            // Akhir Hapus Foto dan Thumbnail
            $user->foto_profil = $fileName;
        }
        
        $user->name = ucwords(strtolower($request->nama));
        $user->username = strtolower($request->username);
        $user->email = strtolower($request->email);
        $user->id_status = $request->status;
        $user->update();

        if ($user->nim) {
            $alumni = Alumni::where('nim', $user->nim)->first();
            $alumni->nama_alumni = ucwords(strtolower($request->nama));
            $alumni->update();
        }

        return redirect('/pengguna')->with('sukses', 'Data Pengguna Berhasil Diubah');
        // return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Diubah', 'cat' => 'primary']);
    }

    public function data() {
        // return datatables(Alumni::all())->toJson();
        $data = User::join('tbl_status', 'users.id_status', '=', 'tbl_status.id')
            ->select('users.*', 'status')
            ->get();
        // $data->map(function($item,$index){
        //     $item->urut = $index+1;
        //     return $item;    
        // })->all();
        return datatables($data)
            // ->editColumn("jenis_kelamin", function($data) {
            //     if ($data->jenis_kelamin == 1) {
            //         return "Laki-laki";
            //     }else{
            //         return "Perempuan";
            //     }
            // })
            // ->editColumn("tmp_lahir", function($data) {
            //     return $data->tmp_lahir.", ".showDateTime($data->tgl_lahir, 'd F Y');
            // })
            ->addColumn('action', function($data) {
                User::where('id_status', '=', 1)->count() == 1 && User::all()->count() == 1 ? $dis = 'disabled' : $dis = '';
                $tombol = 
                            '<button class="item btn btn-primary" data-placement="top" onClick="editPengguna(\''. Crypt::encrypt($data->id) .'\')" title="Edit Data Pengguna">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item btn btn-danger" onClick="hapusPengguna('. $data->id .',\''. $data->name .'\')" data-placement="top" title="Hapus Data Pengguna" data-toggle="modal" data-target="#hapusPengguna" '. $dis . '>
                                <i class="zmdi zmdi-delete"></i>
                            </button>';
                return $tombol;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function akun() {
        return view('admin.akun');
    }

    public function update_akun(Request $request) {
        $id = Auth::user()->id;
        
        $this->validate($request, [
            'nama_lengkap'  => 'required|string',
            'username'      => ['required', 'string', Rule::unique('users')->ignore($id)],
            'email'         => ['required', 'email', Rule::unique('users')->ignore($id)],
        ],[
            'nama_lengkap.required'     => 'Nama Lengkap Harus Diisi',
            'name_lengkap.string'       => 'Nama Lengkap Harus Berupa String',
            'username.required' => 'Username Lengkap Harus Diisi',
            'username.string'   => 'Username Lengkap Harus Berupa String',
            'username.unique'   => 'Username Sudah Ada',
            'email.required'    => 'Email Harus Diisi',
            'email.email'       => 'Email Tidak Valid',
            'email.unique'      => 'Email Sudah Terdaftar',
        ]);

        // return $id;
        $user = User::find($id);
        $user->name = ucwords(strtolower($request->nama_lengkap));
        $user->username = strtolower($request->username);
        $user->email = strtolower($request->email);
        $user->update();

        if (Auth::user()->nim) {
            $alumni = Alumni::where('nim', Auth::user()->nim)->first();
            $alumni->nama_alumni = ucwords(strtolower($request->nama_lengkap));
            $alumni->update();
        }

        return redirect('/akun')->with('sukses', 'Data Pengguna Berhasil Diubah');
        // return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Diubah', 'cat' => 'primary']);
    }

    public function update_password(Request $request) {
        $rules = [
            'password_lama' => 'required',
            'password'      => 'required|confirmed'
        ];
 
        $messages = [
            'password_lama.required'    => 'Password Lama Harus Diisi',
            'password.required'         => 'Password Baru Harus Diisi',
            'password.confirmed'        => 'Password Baru Tidak Sama'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        
        $id = Auth::user()->id;
        $user = User::find($id);
        if (Hash::check($request->password_lama, $user->password) == 1) {
            $user->password = Hash::make($request->password);
            $update = $user->update();
            Auth::logout();
            Session::flush();
            // return redirect('/akun')->with('sukses', 'Password Berhasil Diubah');
            return redirect('/admin')->with('sukses', 'Password Berhasil Diubah, Silakan Login Kembali');
        } else {
            return redirect('/akun')->with('error', 'Password Lama Tidak Sesuai');
        }
    }

    public function update_foto (Request $request) {        
        $this->validate($request, [
            'foto_profil'   => 'image|mimes:jpg,png,jpeg|file|max:2048'
        ],[
            'foto_profil.image' => 'Foto Profil Harus Berbentuk File Gambar',
            'foto_profil.mimes' => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'foto_profil.max'  => 'Ukuran File Tidak Boleh Lebih dari 2 MB'
        ]);

        $file_foto = $request->file('foto_profil');
        if ($file_foto) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file_foto->getClientOriginalExtension();
            Image::make($file_foto)->save($this->path . '/' . $fileName);

            foreach ($this->dimensions as $row) {
                $canvas = Image::canvas($row, $row);
                $resizeImage = Image::make($file_foto)->resize($row, $row, function($constraint) {
                        $constraint->aspectRatio();
                    });

                if (!File::isDirectory($this->path . '/' . $row)) {
                    File::makeDirectory($this->path . '/' . $row, 0777, true, true);
                }

                $canvas->insert($resizeImage, 'center');
                $canvas->save($this->path . '/' . $row . '/' . $fileName);
            }
        }

        // return $id;
        $id = Auth::user()->id;
        $user = User::find($id);

        if ($file_foto) {
            // Hapus Foto dan Thumbnail di Direktori
            File::delete($this->path . '/'. $user->foto_profil);
            foreach ($this->dimensions as $row) {
                File::delete($this->path . '/' . $row . '/' . $user->foto_profil);
            }
            // Akhir Hapus Foto dan Thumbnail
            $user->foto_profil = $fileName;
        }
        $user->update();

        if ($user->nim) {
            $nim = $user->nim;
            $alumni = Alumni::where('nim', $nim)->first();
            $alumni->foto_alumni = $fileName;
            $alumni->update();
        }

        return ($fileName);
    }

    public function cek_user(Request $request) {
        $username = User::where('username', $request->username)->get();
        if($username->count()) {
            return response()->json(array('msg' => 'true'));
        }
        return response()->json(['msg' => 'false']);
    }

    public function cek_email(Request $request) {
        if ($request->id_edit) {
            $email = User::where('id', $request->id_edit)
                            ->pluck('email');
            if ($email[0] != $request->email) {
                $email = User::where('email', $request->email)
                            ->get();
                if ($email->count()) {
                    return response()->json(array('message' => 'true'));
                }
             } 
        } else {
            $email = User::where('email', $request->email)->get();
            if($email->count()) {
                return response()->json(array('message' => 'true'));
            }
        }
        return response()->json(['message' => 'false']);
    }

    public function cek_password(Request $request) {
        $password = User::where('id', Auth::user()->id)
                    ->pluck('password');
        if (Hash::check($request->password_lama, $password[0]) == 1) {
            return response()->json(array('msg' => 'true' ));
        }
        return response()->json(array('msg' => 'false'));
    }
}
