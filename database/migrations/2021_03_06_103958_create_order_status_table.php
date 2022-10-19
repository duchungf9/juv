<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->integer('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();
        });


        Schema::create('order_status_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_status_id');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['order_status_id', 'locale'], 'order_status_translations_order_status_id_locale_unique');

            $table->foreign('order_status_id', 'order_status_translations_order_status_id_foreign')
                ->references('id')->on('order_status')->onDelete('CASCADE')->onUpdate('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
        Schema::dropIfExists('order_status_translations');
    }
}
