<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('subtitle',255);
            $table->text('description')->nullable();
            $table->string('link', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('pub')->nullable()->default(1);

            $table->timestamps();
        });
        Schema::create('links_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('links_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('locale', 255);
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->nullableTimestamps();
            $table->unique(['links_id', 'locale'], 'links_translations_links_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
        Schema::dropIfExists('links_translations');
    }
}
