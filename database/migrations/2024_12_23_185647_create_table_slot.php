<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('table_slot', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('days');
            $table->json('timings');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('table_slot');
    }
};