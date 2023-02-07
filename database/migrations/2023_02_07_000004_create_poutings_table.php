<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoutingsTable extends Migration
{
    public function up()
    {
        Schema::create('poutings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->string('nama_debitur')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('alamat_debitur')->nullable();
            $table->string('status_piutang')->nullable();
            $table->longText('catatan_piutang')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
