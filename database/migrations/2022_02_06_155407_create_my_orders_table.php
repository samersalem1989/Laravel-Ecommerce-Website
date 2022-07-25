<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("buyerId");
            $table->string("buyerName", 255);
            $table->string("buyerEmail", 255);
            $table->string("firstname", 255);
            $table->string("lastname", 255);
            $table->string("email");
            $table->integer("productId");
            $table->string("title", 255);
            $table->integer("quantity");
            $table->string("price", 255);
            $table->string("total", 255);
            $table->string("image", 255);
            $table->string("description", 255);
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
        Schema::dropIfExists('my_orders');
    }
}
