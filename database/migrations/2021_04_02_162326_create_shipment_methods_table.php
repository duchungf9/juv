<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_methods', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->decimal('fee',20,2)->nullable();
            $table->decimal('free_shipping_from',20,2)->nullable();

            $table->integer('sort')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('shipment_method_translations', function (Blueprint $table) {
            $table->id('id');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['shipment_method_id', 'locale']);
            $table->foreignId('shipment_method_id')
                ->constrained()
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_methods');
        Schema::dropIfExists('shipment_method_translations');
    }
}
