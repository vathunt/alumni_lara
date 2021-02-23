<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPengumuman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pengumuman');
            $table->text('isi_pengumuman');
            $table->date('tgl_pengumuman');
            $table->text('gambar_pengumuman');
            $table->text('lampiran_pengumuman');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pengumuman');
    }
}
