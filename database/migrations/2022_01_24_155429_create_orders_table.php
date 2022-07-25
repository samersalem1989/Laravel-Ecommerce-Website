<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("SaleId", 255)->nullable();
            $table->string("firstname", 255)->nullable();
            $table->string("lastname", 255)->nullable();
            $table->string("city", 255)->nullable();
            $table->string("email")->nullable();
            $table->text("address", 255)->nullable();
            $table->string("TransactionAmount", 255);
            // $table->decimal("TransactionAmount",6, 2);
            $table->string("DocumentURL", 255)->nullable();
            $table->string("SaleTime", 255)->nullable();
            $table->string("TransactionCardName", 255)->nullable();
            $table->string("TransactionCardNum", 255);
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
        Schema::dropIfExists('orders');
    }
}
