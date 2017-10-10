<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('order', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('sum');
              $table->string('name');
              $table->string('phone');
              $table->integer('kol');
              $table->text('comment');
              $table->integer('book_id');
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
        Schema::drop('order');
    }
}
