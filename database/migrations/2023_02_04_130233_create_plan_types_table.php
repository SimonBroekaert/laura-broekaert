<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('plan_types', function (Blueprint $table) {
            $table->id();
            $table->string('developer_id')
                ->unique()
                ->nullable();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('location_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->integer('amount_of_persons');
            $table->boolean('is_online')
                ->default(false);
            $table->integer('order')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_types');
    }
};
