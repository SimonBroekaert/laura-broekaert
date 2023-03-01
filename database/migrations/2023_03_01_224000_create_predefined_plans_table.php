<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('predefined_plans', function (Blueprint $table) {
            $table->id();
            $table->string('developer_id')
                ->unique()
                ->nullable();
            $table->string('name');
            $table->string('slug');
            $table->json('bundles')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->boolean('is_online')
                ->default(false);
            $table->integer('order')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('predefined_plans');
    }
};
