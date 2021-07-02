<?php
// 083 850 296 980
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Alumni;
use App\User;
use Session;
use Alert;
use Carbon\Carbon;
use File;
use Image;
use App\Imports\AlumniImport;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AlumniController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->path       = public_path('/images/users');
        $this->dimensions = ['180', '240'];
    }

    public function index() {
    	// return view('admin.alumni', ['alumni' => $alumni]);
        return view('admin.alumni');
    }

    public function simpan(Request $request) {
        $this->validate($request, [
            'nim'           => 'required|digits_between:10,10|numeric',
            'nama_alumni'   => 'required|string',
            'tmp_lahir'     => 'required|string',
            'tgl_lahir'     => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'foto_alumni'   => 'image|mimes:jpg,png,jpeg|file|max:2048'
        ],[
            'nim.required'           => 'NIM Harus Diisi',
            'nim.numeric'            => 'NIM Harus Berupa Angka',
            'nim.digits_between'     => 'NIM Harus 10 Karakter',
            'nama_alumni.required'   => 'Nama Harus Diisi',
            'nama_alumni.string'     => 'Nama Hanya Berupa Huruf',
            'tmp_lahir.required'     => 'Tempat Lahir Harus Diisi',
            'tmp_lahir.string'       => 'Tempat Lahir Hanya Berupa Huruf', 
            'tgl_lahir.required'     => 'Tanggal Lahir Harus Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Dipilih',
            'alamat.required'        => 'Alamat Harus Diisi',
            'foto_alumni.image'      => 'Foto Profil Harus Berbentuk File Gambar',
            'foto_alumni.mimes'      => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'foto_alumni.max'        => 'Ukuran File Tidak Boleh Lebih dari 2 MB'
        ]);

        // Buat Folder Jika Belum Ada
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0777, true, true);
        }

        $file_foto = $request->file('foto_alumni');
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

        $alumni                = new Alumni;
        $alumni->nim           = $request->nim;
        $alumni->nama_alumni   = $request->nama_alumni;
        $alumni->tmp_lahir     = $request->tmp_lahir;
        $alumni->tgl_lahir     = $request->tgl_lahir;
        $alumni->jenis_kelamin = $request->jenis_kelamin;
        $alumni->alamat        = $request->alamat;
        $alumni->foto_alumni   = $fileName;
    	$alumni->save();
        return redirect('/alumni')->with('sukses', 'Data Alumni Berhasil Disimpan');
    	// return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Disimpan', 'cat' => 'success']);
    }

    public function destroy(Request $request){
        $id = $request->id;
        $alumni = Alumni::find($id);

        // Hapus Foto dan Thumbnail di Direktori
        File::delete($this->path . '/'. $alumni->foto_alumni);
        foreach ($this->dimensions as $row) {
            File::delete($this->path . '/' . $row . '/' . $alumni->foto_alumni);
        }
        // Akhir Hapus Foto dan Thumbnail

        $alumni->delete();
        return redirect('/alumni')->with('sukses', 'Data Alumni Berhasil Dihapus');
        // return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Dihapus', 'cat' => 'warning']);
    }

    public function edit($id){
        $alumni = Alumni::find($id);
        return response()->json($alumni);
    }

    public function lihat($id){
        $alumni = Alumni::find($id);
        return response()->json($alumni);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'nim'           => 'required|digits_between:10,10|numeric',
            'nama_alumni'   => 'required|string',
            'tmp_lahir'     => 'required|string',
            'tgl_lahir'     => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'foto_alumni'   => 'image|mimes:jpg,png,jpeg|file|max:2048'
        ],[
            'nim.required'           => 'NIM Harus Diisi',
            'nim.numeric'            => 'NIM Harus Berupa Angka',
            'nim.digits_between'     => 'NIM Harus 10 Karakter',
            'nama_alumni.required'   => 'Nama Harus Diisi',
            'nama_alumni.string'     => 'Nama Hanya Berupa Huruf',
            'tmp_lahir.required'     => 'Tempat Lahir Harus Diisi',
            'tmp_lahir.string'       => 'Tempat Lahir Hanya Berupa Huruf', 
            'tgl_lahir.required'     => 'Tanggal Lahir Harus Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Dipilih',
            'alamat.required'        => 'Alamat Harus Diisi',
            'foto_alumni.image'      => 'Foto Profil Harus Berbentuk File Gambar',
            'foto_alumni.mimes'      => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'foto_alumni.max'        => 'Ukuran File Tidak Boleh Lebih dari 2 MB'

        ]);

        $file_foto = $request->file('foto_alumni');
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

        $id        = $request->idEdit;
        $tgl_lahir = $request->tgl_lahir;
        $date      = str_replace('/', '-', $tgl_lahir);
        $date      = date('Y-m-d', strtotime($date));
        $alumni    = Alumni::find($id);

        if ($file_foto) {
            // Hapus Foto dan Thumbnail di Direktori
            File::delete($this->path . '/'. $alumni->foto_alumni);
            foreach ($this->dimensions as $row) {
                File::delete($this->path . '/' . $row . '/' . $alumni->foto_alumni);
            }
            // Akhir Hapus Foto dan Thumbnail
            $alumni->foto_alumni = $fileName;
        }

        $alumni->nim           = $request->nim;
        $alumni->nama_alumni   = $request->nama_alumni;
        $alumni->tmp_lahir     = $request->tmp_lahir;
        $alumni->tgl_lahir     = $date;
        $alumni->jenis_kelamin = $request->jenis_kelamin;
        $alumni->alamat        = $request->alamat;
        $alumni->update();

        $user = User::where('nim', $alumni->nim)->first();
        if ($user) {
            $user->name = ucwords(strtolower($request->nama_alumni));
            $user->update();
        }

        return redirect('/alumni')->with('sukses', 'Data Alumni Berhasil Diubah');
        // return redirect('/alumni')->with(['pesan' => 'Data Alumni Berhasil Diubah', 'cat' => 'primary']);
    }

    public function data() {
        // return datatables(Alumni::all())->toJson();
        $data = Alumni::latest()->get();
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
            ->editColumn("tmp_lahir", function($data) {
                return $data->tmp_lahir.", ".showDateTime($data->tgl_lahir, 'd F Y');
            })
            ->addColumn('action', function($data) {
                $tombol = 
                            '<button class="item btn btn-primary" data-placement="top" onClick="editAlumni('. $data->id .')" title="Edit Data Alumni">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item btn btn-danger" onClick="hapusAlumni('. $data->id .',\''. $data->nama_alumni .'\')" data-placement="top" title="Hapus Data Alumni" data-toggle="modal" data-target="#hapusAlumni">
                                <i class="zmdi zmdi-delete"></i>
                            </button>';
                return $tombol;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function import_data(Request $request) {
        //validasi
        $this->validate($request, [
            'file_import' => 'required|mimes:csv,xls,xlsx'
        ],[
            'file_import.required' => 'File Belum Dipilih',
            'file_import.mimes'    => 'Hanya file *.csv, *.xls dan *.xlsx yang bisa diproses'
        ]);
 
        // menangkap file excel
        $file = $request->file('file_import');
 
        // membuat nama file unik
        // $nama_file = rand().$file->getClientOriginalName();
        
        // upload ke folder file di dalam folder public
        // $file->move('file', $nama_file);

        // import data
        // Excel::import(new AlumniImport, public_path('/file/'.$nama_file));
        // $import = Excel::import(new AlumniImport, $file);
        try {
            $import = Excel::import(new AlumniImport, $file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures     = $e->failures();
            $errormessage = "";
            return dd($failures);
             
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }
 
        // alihkan halaman kembali
        // if ($import) {
        //     return redirect('/alumni')->with('sukses', 'Data Alumni Berhasil Diimport');
        // } else {
        //     return redirect('/alumni')->with('error', 'Data Alumni Gagal Diimport');
        // }
    }

    public function export_excel() {
        $date = date('d-m-y');
        $excel_title = 'data_alumni_'.$date;
        // return $excel_title;
        return Excel::download(new AlumniExport, $excel_title.'.xlsx');
    }

    public function cek_nim(Request $request) {
        if ($request->id_edit) {
            $alumni = Alumni::where('id', $request->id_edit)
                            ->pluck('nim');
            if ($alumni[0] != $request->nim) {
                $alumni = Alumni::where('nim', $request->nim)
                            ->get();
                if ($alumni->count()) {
                    return response()->json(array('msg' => 'true'));
                }
             } 
        } else {
            $alumni = Alumni::where('nim', $request->nim)->get();
            if($alumni->count()) {
                return response()->json(array('msg' => 'true'));
            }
        }
        return response()->json(array('msg' => 'false'));
    }

    public function cari_nim(Request $request) {
        $alumni = Alumni::where('nim', 'LIKE', '%'.$request->nimReg.'%')->get();
        $output = '<ul class="list-unstyled">';
        if($alumni->count()){
            foreach ($alumni as $data) {
                $output .= '<li class="nimReg">'.$data->nim.'</li>';
            }
        } else {
            $output .= '<li>NIM Tidak Ditemukan</li>';  
        }  
        $output .= '</ul>';
        return $output;
    }

    public function find_nim(Request $request) {
        $alumni = Alumni::where('nim', $request->nimFind)->get();
        return response()->json($alumni);
    }
}