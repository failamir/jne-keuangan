<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSetoransTable extends Migration
{
    public function up()
    {
        Schema::table('setorans', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7990681')->references('id')->on('users');
            $table->unsignedBigInteger('piutang_id')->nullable();
            $table->foreign('piutang_id', 'piutang_fk_7990766')->references('id')->on('poutings');
        });
    }
}
