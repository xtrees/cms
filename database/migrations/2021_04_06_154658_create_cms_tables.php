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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(1);
            $table->string('name', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('phone', 11)->nullable();
            $table->string('avatar')->nullable();
            $table->string('password', 200);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedInteger('coins')->default(0)->comment('金币数量');
            $table->boolean('blocked')->default(0)->comment('锁定');
            $table->string('source', 20)->default('web')->comment('注册来源');
            $table->timestamp('activated_at')->nullable()->comment('活跃时间');
            $table->boolean('robot')->default(false);
            $table->timestamp('role_expired_at')->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('icon')->nullable();
            $table->unsignedInteger('permission')->default(0)->comment('权限等级');
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->morphs('favoriteable');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->string('title', 100)->default('');
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->unsignedInteger('total')->default(0)->comment('总计文章');
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedInteger('permission')->default(0)->comment('权限等级');
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
            $table->unsignedInteger('permission')->default(0)->comment('权限等级');
            $table->unsignedInteger('coins')->default(0)->comment('金币');
            $table->timestamp('published_at')->nullable();
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id');
            $table->string('storage', 20)->default('local');
            $table->string('path');
            $table->boolean('cover')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_group_id');
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->string('title', 100);
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->unsignedInteger('total')->default(0)->comment('总数');
            $table->unsignedTinyInteger('position')->default(0)->comment('位置');
            $table->boolean('display')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('tag_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->string('title', 100);
            $table->string('keywords', 100)->default('');
            $table->string('summary', 200)->default('');
            $table->integer('sort')->default(0);
            $table->boolean('display')->default(false);
            $table->timestamps();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->foreignId('tag_id');
            $table->morphs('taggable');
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
            $table->unsignedInteger('permission')->default(0)->comment('权限等级');
            $table->boolean('display')->default(false);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('content');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('favorites')->default(0);
            $table->unsignedInteger('coins')->default(0)->comment('金币');
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->morphs('commentable');
            $table->string('content')->nullable();
            $table->unsignedInteger('likes')->default(0)->comment('点赞');
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
            $table->unsignedInteger('permission')->default(0)->comment('权限等级');
            $table->timestamps();
        });

        Schema::create('collection_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedInteger('sort')->default(0);
            $table->unique(['content_id', 'collection_id']);
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id');
            $table->string('title', 50);
            $table->string('icon', 50)->nullable();
            $table->string('url', 50)->nullable();
            $table->string('target', 50)->default('_self');
            $table->bigInteger('parent_id')->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('display')->default(true);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('images');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_groups');
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('collection_contents');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
    }
}
