<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataChisocothe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chisocothe', function (Blueprint $table) {
            $table->id();

            // chiều cao : 1m
            $table->integer('Chieucao');

            // cân nặng  : 60kg
            $table->integer('Cannang');

            // năm tuổi : 20
            $table->integer('Namtuoi');

            // giới tính : nam
            $table->string('Gioitinh');

            // nhịp tim : 123
            $table->integer('Nhiptim');

            // nồng độ oxy : 123
            $table->integer('Nongdooxy');

            // huyết ap :123
            $table->integer('Huyetap');

            // nhiệt độ : 38
            $table->integer('Nhietdo');

            // hình ảnh nội soi () khóa ngoại


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
        Schema::dropIfExists('chisocothe');
    }
}
