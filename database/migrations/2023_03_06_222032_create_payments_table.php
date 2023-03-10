<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable');
            $table->string('code')
                ->unique();
            $table->string('status');
            $table->string('method');
            $table->integer('price');
            $table->integer('discount_percentage')
                ->default(0);
            $table->integer('discount_amount');
            $table->integer('tax_percentage')
                ->default(0);
            $table->integer('tax_amount');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
