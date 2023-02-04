<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_type_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('developer_id')
                ->unique()
                ->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description')
                ->nullable();
            $table->integer('amount_of_sessions')
                ->nullable();
            $table->integer('base_price');
            $table->integer('discount_percentage')
                ->default(0);
            $table->integer('discount_amount')
                ->default(0);
            $table->integer('tax_percentage')
                ->default(0);
            $table->integer('tax_amount')
                ->default(0);
            $table->integer('total_price');
            $table->boolean('is_online')
                ->default(false);
            $table->integer('order')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
