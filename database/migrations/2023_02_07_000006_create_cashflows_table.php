<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashflowsTable extends Migration
{
    public function up()
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategori_cashflow')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('sumber')->nullable();
            $table->string('status')->nullable();
            $table->longText('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
