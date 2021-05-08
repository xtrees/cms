<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->string('title', 100)->default('');
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->unsignedInteger('total')->default(0)->comment('总计文章');
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('display')->default(false);
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable();
            $table->unsignedTinyInteger('type')->default(0)->comment('内容类型');
            $table->string('slug', 100)->nullable()->unique();
            $table->string('title', 100);
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->text('body')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('favorites')->default(0);
            $table->unsignedInteger('level')->default(0)->comment('权限等级');
            $table->timestamps();
        });


        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->nullable();
            $table->string('storage', 20)->default('local');
            $table->string('path');
            $table->boolean('cover')->default(false);
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_group_id');
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('title', 100)->nullable();
            $table->string('keywords', 100)->nullable();
            $table->string('summary', 200)->nullable();
            $table->unsignedInteger('total')->default(0)->comment('总数');
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('tag_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('title', 100)->nullable();
            $table->string('keywords', 100)->nullable();
            $table->string('summary', 200)->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('taggable', function (Blueprint $table) {
            $table->foreignId('tag_id');
            $table->foreignId('content_id');
            $table->unique(['tag_id', 'content_id']);
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('uri')->nullable()->unique();
            $table->string('name', 50)->nullable()->unique();
            $table->string('title', 100);
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->string('template')->default('default');
            $table->json('data');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('content_id');
            $table->text('content')->nullable();
            $table->unsignedInteger('thumbs-up')->default(0)->comment('点赞');
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 100)->unique();
            $table->string('title', 100)->default('');
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->text('body')->nullable();
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        Schema::create('content_collection', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedInteger('sort')->default(0);
            $table->unique(['content_id', 'collection_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('images');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_groups');
        Schema::dropIfExists('taggable');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('content_collection');
    }
}
