<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'tbl_pengumuman';

    protected $dates = ['tgl_pengumuman'];

    protected $fillable = [
        'judul_pengumuman', 'isi_pengumuman', 'tgl_pengumuman', 'gambar_pengumuman', 'lampiran_pengumuman', 'id_user'
    ];

    protected $casts = [
	    'lampiran_pengumuman' => 'array',
	];
}
