<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->nullable();
            $table->string('code', 255)->unique()->nullable();

            $table->string('title', 255);
            $table->string('subtitle', 255)->nullable();
            $table->string('btn_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('icon', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('is_one_time')->nullable()->default(0);
            $table->unsignedInteger('sort')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('widget_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('widget_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->string('btn_title', 255)->nullable();
            $table->text('description')->nullable();
            $table->nullableTimestamps();
            $table->unique(['widget_id', 'locale'], 'widget_translations_widget_id_locale_unique');
            $table->index('locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgets');
    }
}
