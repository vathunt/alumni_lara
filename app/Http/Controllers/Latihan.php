<?php

namespace App\Http\Controllers;
use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Latihan extends Controller
{
    public function index(Request $request) {

    	$data  = Alumni::offset($request->start)
    			->limit($request->length)
    			->get();

    	return response()->json([
    		'data'=>$data,
    		'draw'=>1,
    		'recordsFiltered'=>Alumni::where('nama_alumni','like','%fauzul%')->count('id'),
    		'recordsTotal'=>Alumni::count('id')
    	]);
    }

    public function view(Request $request) {
    	
    	return view('admin.latihan');
    }

    public function index2(Request $request) {
    	$columns = array(
		    array( 'db' => 'nim','dt' => 0 ),
		    array( 'db' => 'nama_alumni','dt' => 1 ),
		    array( 'db' => 'tmp_lahir','dt' => 2 ),
		    array( 'db' => 'tgl_lahir', 'dt' => 3 ),
		    array( 'db' => 'jenis_kelamin', 'dt' => 4 ),
		    array( 'db' => 'alamat', 'dt' => 5 ),
		    array( 'db' => 'id', 'dt' => 6 ),
		);
		 
		$con = array(
		    'user' => 'root',
		    'pass' => '',
		    'db'   => 'db_alumni_lara',
		    'host' => 'localhost'
		);


    	\App\Helpers\SpHelper::simple($request,$con,'alumni','id', $columns);
    	return view('admin.latihan');
    }

    public function latihan(Request $request) {
        $request->validate([
            'file' => 'required',
        ]);
 
       $title = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('posts'), $title);
 
       $storeFile = new Post;
       $storeFile->title = $title;
       $storeFile->save();
  
        return response()->json(['success'=>'File Uploaded Successfully']);
    }

    public function data(){
        
        $parameter =[
            'nama' => 'Diki Alfarabi Hadi',
            'pekerjaan' => 'Programmer',
        ];
        $enkripsi= Crypt::encrypt($parameter);
        echo "<a href='data/".$enkripsi."'>Klik</a>";
        // return response()->json($enkripsi);
    }

    public function data_enkripsi($data){
        $data = Crypt::decrypt($data);
        // return $data;
        echo "Nama : " . $data['nama'];
        echo "<br/>";
        echo "Pekerjaan : " . $data['pekerjaan'];
    }

    public function crop()
    {
        return view('crop');
    }
 
    public function uploadCropImage(Request $request)
    {
        $folderPath = public_path('upload/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);
 
         // $saveFile = new Picture;
         // $saveFile->name = $imageName;
         // $saveFile->save();
    
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
}