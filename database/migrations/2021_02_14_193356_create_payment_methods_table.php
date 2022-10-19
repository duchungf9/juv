<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->string('code', 255)->unique();
            $table->boolean('is_active')->nullable()->default(1);
            $table->integer('sort')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_method_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('note', 255)->nullable();

            $table->timestamps();


            $table->unique(['payment_method_id', 'locale'], 'payment_method_translations_payment_method_id_locale_unique');
            $table->index('locale', 'payment_methods_translations_locale_index');

            $table->foreignId('payment_method_id')
                ->constrained()
                ->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('payment_method_translations');
    }
}
