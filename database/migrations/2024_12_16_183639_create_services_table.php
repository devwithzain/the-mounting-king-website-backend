<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};