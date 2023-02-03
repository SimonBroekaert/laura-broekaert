<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('label');
            $table->json('link');
            $table->integer('order')
                ->nullable();
            $table->boolean('is_online')
                ->default(false);
            $table->boolean('opens_in_new_tab')
                ->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
};
