<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim')->unique();
            $table->string('nama_alumni');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', [1, 0]);
            $table->text('alamat');
            $table->text('foto_alumni')->nullable();
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
        Schema::dropIfExists('tbl_alumni');
    }
}
