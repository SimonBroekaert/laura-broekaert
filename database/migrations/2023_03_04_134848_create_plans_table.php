<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('code')
                ->unique();
            $table->integer('amount_of_persons');
            $table->integer('amount_of_sessions');
            $table->string('status');
            $table->integer('price');
            $table->integer('discount_percentage')
                ->default(0);
            $table->integer('discount_amount');
            $table->integer('tax_percentage')
                ->default(0);
            $table->integer('tax_amount');
            $table->integer('total_price');
            $table->foreignId('location_id')
                ->nullable()
                ->constrained('locations')
                ->nullOnDelete();
            $table->text('external_location')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
