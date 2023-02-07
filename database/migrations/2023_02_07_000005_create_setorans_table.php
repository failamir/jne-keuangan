<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetoransTable extends Migration
{
    public function up()
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('jumlah_setoran', 15, 2)->nullable();
            $table->date('tanggal_setoran')->nullable();
            $table->string('metode_setoran')->nullable();
            $table->string('status_setoran')->nullable();
            $table->longText('catatan_setoran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
