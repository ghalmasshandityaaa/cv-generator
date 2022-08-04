<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatependidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tingkat');
            $table->string('universitas');
            $table->string('jurusan');
            $table->string('bln_mulai');
            $table->string('thn_mulai');
            $table->string('bln_selesai')->nullable();
            $table->string('thn_selesai')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('ipk');
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
        Schema::dropIfExists('pendidikans');
    }
}
