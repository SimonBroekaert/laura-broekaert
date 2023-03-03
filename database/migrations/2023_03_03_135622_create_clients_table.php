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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')
                ->virtualAs('CONCAT(first_name, " ", last_name)');
            $table->string('email')
                ->unique();
            $table->string('phone')
                ->nullable()
                ->unique();
            $table->date('date_of_birth')
                ->nullable();
            $table->string('status');
            $table->foreignId('client_business_id')
                ->nullable()
                ->constrained('client_businesses')
                ->nullOnDelete();
            $table->foreignId('predefined_plan_id')
                ->nullable()
                ->constrained('predefined_plans')
                ->nullOnDelete();
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
        Schema::dropIfExists('clients');
    }
};
