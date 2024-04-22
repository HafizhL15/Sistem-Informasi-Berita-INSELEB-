<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('user_id');
            $table->foreignId('author_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description');
            $table->text('excerpt');
            $table->text('body');
            $table->string('sumber')->nullable();
            $table->boolean('headline')->default(false);
            $table->boolean('pilihan')->default(false);
            $table->boolean('rekomendasi')->default(false);
            $table->boolean('status')->default(false);
            $table->string('image')->nullable();
            $table->string('caption')->nullable();
            $table->string('credit')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('views')->nullable();

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
        Schema::dropIfExists('articles');
    }
};
