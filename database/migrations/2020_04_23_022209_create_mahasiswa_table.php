<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->char('npm', 10)->primary();
            $table->string('nama',20);
            $table->year('tahun_masuk');
            $table->integer('status')->length(10)->unsigned();
            $table->char('nidn', 10)->index();
            $table->timestamps();

            $table->foreign('nidn')
            ->references('nidn')
            ->on('dosen')
            ->onUpdate('cascade');

            $table->foreign('npm')
            ->references('npm')
            ->on('krs')
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
        Schema::dropIfExists('mahasiswa');
    }
}
