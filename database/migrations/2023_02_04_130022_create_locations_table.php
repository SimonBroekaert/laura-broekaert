<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('developer_id')
                ->unique()
                ->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('street');
            $table->string('street_number');
            $table->string('city');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
