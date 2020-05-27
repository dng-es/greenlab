<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('member_id')->default(0);
            $table->bigInteger('product_id');
            $table->bigInteger('supplier_id')->default(0);
            $table->float('price', 8, 2)->default(0);
            $table->float('amount', 8, 2)->default(0);
            $table->float('amount_real', 8, 2)->default(0);
            $table->float('total', 8, 2)->default(0);
            $table->char('type')->default('S');
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
        Schema::dropIfExists('warehouses');
    }
}
