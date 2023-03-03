<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contact_form_entries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')
                ->virtualAs('CONCAT(first_name, " ", last_name)');
            $table->string('email');
            $table->string('phone')
                ->nullable();
            $table->string('subject');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_form_entries');
    }
};
