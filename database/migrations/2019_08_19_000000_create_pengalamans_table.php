<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengalamans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jabatan');
            $table->string('perusahaan');
            $table->string('negara');
            $table->integer('gaji');
            $table->string('jns_karyawan');
            $table->string('bln_mulai');
            $table->string('thn_mulai');
            $table->string('bln_selesai')->nullable();
            $table->string('thn_selesai')->nullable();
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('pengalamans');
    }
}
