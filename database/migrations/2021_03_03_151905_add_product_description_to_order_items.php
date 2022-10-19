<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductDescriptionToOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('rife', 20)->nullable();
            $table->after('product_model_code', function ($table) {
                $table->string('product_title', 512)->nullable();
                $table->string('product_description', 512)->nullable();
            });

            $table->after('price', function ($table) {
                $table->decimal('reduction_amount', 20,3)->nullable();
                $table->decimal('final_price', 20,3)->nullable();
                $table->decimal('total_price', 20,3)->nullable();
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
}
