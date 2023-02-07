<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSetoransTable extends Migration
{
    public function up()
    {
        Schema::table('setorans', function (Blueprint $table) {
            $table->unsignedBigInteger('piutang_id')->nullable();
            $table->foreign('piutang_id', 'piutang_fk_7991873')->references('id')->on('piutangs');
        });
    }
}
