<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('developer_id')
                ->unique()
                ->nullable();
            $table->string('title');
            $table->string('slug');
            $table->json('body')
                ->nullable();
            $table->boolean('is_online')
                ->default(false);
            $table->string('seo_title')
                ->nullable();
            $table->string('seo_description')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
