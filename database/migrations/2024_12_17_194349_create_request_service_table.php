<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('request_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_title');
            $table->text('service_description');
            $table->timestamps();
        });
        Schema::create('request_services_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_services_id')->constrained('request_services')->onDelete('cascade');
            $table->string('step_title');
            $table->text('step_description');
            $table->timestamps();
        });
        Schema::create('request_services_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_services_steps_id')->constrained('request_services_steps')->onDelete('cascade');
            $table->string('size');
            $table->integer('time');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_services');
        Schema::dropIfExists('request_services_steps');
        Schema::dropIfExists('request_services_options');
    }
};