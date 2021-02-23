<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Pengumuman;
use Carbon\Carbon;
use File;
use Image;

class PengumumanController extends Controller
{
	public $path;
    public $dimensions;

    public function __construct()
    {
        //Path Gambar
        $this->pathGambar = public_path('/images/pengumuman');
        //Path Lampiran
        $this->pathLampiran = public_path('/file/pengumuman');
        //Dimensi
        $this->dimensions = ['360'];
    }

    public function index() {
    	return view('admin.pengumuman');
    }

    public function data() {
        $data = Pengumuman::join('users', 'tbl_pengumuman.id_user', '=', 'users.id')
            ->select('tbl_pengumuman.*', 'name')
            ->get();
        return datatables($data)
        	->editColumn("tgl_pengumuman", function($data) {
                return showDateTime($data->tgl_pengumuman, 'd F Y');
            })
            ->editColumn("isi_pengumuman", function($data) {
                return Str::of(strip_tags($data->isi_pengumuman))->words(20, ' .....');
            })
            ->addColumn('action', function($data) {
                $tombol = 
                            '<button class="item btn btn-primary" data-placement="top" onClick="editPengumuman(\''. $data->id .'\')" title="Edit Data Pengumuman">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item btn btn-danger" onClick="hapusPengumuman('. $data->id .',\''. $data->name .'\')" data-placement="top" title="Hapus Data Pengumuman" data-toggle="modal" data-target="#hapusPengumuman">
                                <i class="zmdi zmdi-delete"></i>
                            </button>';
                return $tombol;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function simpan(Request $request) {
    	$this->validate($request, [
            'judul_pengumuman' => 'required',
            'isi_pengumuman' => 'required',
            'tgl_pengumuman' => 'required',
            'gambar_pengumuman' => 'image|mimes:jpg,png,jpeg|file|max:2048',
            'lampiran_pengumuman' => 'max:15000',
        ],[
            'judul_pengumuman.required' => 'Judul Pengumuman Harus Diisi',
            'isi_pengumuman.required' => 'Isi Pengumuman Harus Diisi',
            'tgl_pengumuman.required' => 'Tanggal Pengumuman Harus Diisi',
            'gambar_pengumuman.image' => 'Gambar Pengumuman Harus Berbentuk File Gambar',
            'gambar_pengumuman.mimes' => 'Ekstensi Yang Diijinkan Harus *.png, *.jpg, *.jpeg',
            'gambar_pengumuman.max'  => 'Ukuran File Tidak Boleh Lebih dari 2 MB',
            'lampiran_pengumuman.max'  => 'Ukuran File Tidak Boleh Lebih dari 15 MB'
        ]);

    	// Proses Gambar Pengumuman
        if (!File::isDirectory($this->pathGambar)) {
        	// Buat Folder pengumuman dalam folder image
            File::makeDirectory($this->pathGambar, 0777, true, true);
        }

        $gambar_pengumuman = $request->file('gambar_pengumuman');
        if ($request->hasFile('gambar_pengumuman')) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $gambar_pengumuman->getClientOriginalExtension();
            Image::make($gambar_pengumuman)->save($this->pathGambar . '/' . $fileName);

            foreach ($this->dimensions as $row) {
                // Auto Width | Height 360px
                $resizeImage = Image::make($gambar_pengumuman)->resize(null, $row, function($constraint) {
                    $constraint->aspectRatio();
                });

                if (!File::isDirectory($this->pathGambar . '/' . $row)) {
                    File::makeDirectory($this->pathGambar . '/' . $row, 0777, true, true);
                }

                $resizeImage->save($this->pathGambar . '/' . $row . '/' . $fileName);
            }
        } else {
            $fileName = '';
        }

        // Proses Lampiran Pengumuman
        if (!File::isDirectory($this->pathLampiran)) {
        	// Buat Folder pengumuman dalam folder lampiran
            File::makeDirectory($this->pathLampiran, 0777, true, true);
        }

        $lamp = [];
        $lampiran_pengumuman = $request->file('lampiran_pengumuman');
        if ($request->hasFile('lampiran_pengumuman')) {
            foreach ($lampiran_pengumuman as $lampiran) {
                $fileLamp = Carbon::now()->timestamp . '_' . uniqid() . '.' . $lampiran->getClientOriginalExtension();
                array_push($lamp, $fileLamp);
                $lampiran->move($this->pathLampiran . '/', $fileLamp);
            }
        } else {
            $lamp = '';
        }

    	$pengumuman = new Pengumuman;
    	$pengumuman->judul_pengumuman 		= $request->judul_pengumuman;
    	$pengumuman->isi_pengumuman			= $request->isi_pengumuman;
    	$pengumuman->tgl_pengumuman			= $request->tgl_pengumuman;
    	$pengumuman->gambar_pengumuman		= $fileName;
    	$pengumuman->lampiran_pengumuman	= $lamp;
    	$pengumuman->id_user				= Auth::user()->id;
    	$pengumuman->save();

        return response()->json(['pesan' => 'Data Pengumuman Berhasil Disimpan']);
    }
}
