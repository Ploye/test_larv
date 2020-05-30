<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatakuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode_matakuliah', 10);
            $table->char('nama_matakuliah', 100);
            $table->integer('sks')->length(10)->unsigned();
            $table->integer('semester')->length(10)->unsigned();
            $table->integer('status')->length(10)->unsigned();
            $table->char('nidn', 10)->index();
           
            $table->timestamps();

            $table->foreign('kode_matakuliah')
            ->references('kode-matakuliah')
            ->on('krs')
            ->onUpdate('cascade');

            $table->foreign('nidn')
            ->references('nidn')
            ->on('dosen')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
}
