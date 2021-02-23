<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Alumni extends Model
{
    protected $table = 'tbl_alumni';

    protected $dates = ['tgl_lahir'];

    protected $fillable = [
        'nim', 'nama_alumni', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'foto_alumni'
    ];
}
