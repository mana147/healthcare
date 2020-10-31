<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Donthuoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donthuoc', function (Blueprint $table) {
            $table->increments('id');

            $table->text('chuandoanbenh')->default('text');
            $table->string('tenthuoc')->unique();
            $table->string('donvi')->default('text');
            $table->integer('soluong')->default('text');
            $table->text('lieudung')->default('text');

            $table->integer('id_sokhambenh')->unsigned();
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
        // Schema::dropIfExists('donthuoc');
    }
}
