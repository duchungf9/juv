<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateHpslidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpsliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->text('description');
            $table->string('icon', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('sort')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('hp_slider_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('hp_slider_id')
                ->constrained('hpsliders')
                ->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['hp_slider_id', 'locale'], 'hp_sliders_translations_hp_slider_id_locale_unique');
            $table->index('locale', 'hp_sliders_translations_locale_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hpsliders');
    }
}
