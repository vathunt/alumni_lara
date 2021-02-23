<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ClientController extends Controller
{
    public function index() {
        $pengumuman = DB::table('tbl_pengumuman')
                        ->orderByDesc('tgl_pengumuman')
                        ->limit(3)
                        ->get();
        return view('index', ['announcements' => $pengumuman]);
    }

    public function search(Request $request) {
        if ($request->search) {
            if ($request->ajax()) {
                $output = "";
                $alumni = Db::table('tbl_alumni')
                            ->where('nama_alumni', 'LIKE', '%'.$request->search.'%')
                            ->orwhere('nim', 'LIKE', '%'.$request->search.'%')
                            ->get();
                if ($alumni->count() > 0) {
                    foreach ($alumni as $key => $data) {
                        $output.='<tr>'.
                        '<td>'.$data->nim.' - '.
                        $data->nama_alumni.' '.
                        '<i class="fas fa-external-link-alt link-icon" onClick="lihatAlumni('. $data->id .')"></i></td>'.
                        '</tr>';
                    }

                    return Response($output);
                } else {
                    return "<td><h5><span class='badge badge-danger'>Data Tidak Ditemukan</span></h5></td>";
                }
            }
        }
    }

    public function lihat_pengumuman($id) {
        $dt_pengumuman = Db::table('tbl_pengumuman')->where('id', '=', Crypt::decryptString($id))->first();
        return view('lihat_pengumuman')->with('dt_pengumuman', $dt_pengumuman);
    }
}