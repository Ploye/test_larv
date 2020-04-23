<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode_matakuliah', 10)->index();
            $table->char('nidn',10)->index();
            $table->char('kelas',1);
            $table->char('hari',10);
            $table->timestamp('jam');
            $table->timestamps();

            $table->foreign('nidn')
            ->references('nidn')
            ->on('dosen')
            ->onUpdate('cascade');

            $table->foreign('kode_matakuliah')
            ->references('kode_matakuliah')
            ->on('matakuliah')
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
        Schema::dropIfExists('jadwal');
    }
}
