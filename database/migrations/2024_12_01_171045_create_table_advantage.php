<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('advantage', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subTitle');
            $table->string('serviceTitle1');
            $table->string('serviceTitle2');
            $table->string('serviceTitle3');
            $table->string('serviceDescription1');
            $table->string('serviceDescription2');
            $table->string('serviceDescription3');
            $table->string('serviceImage1');
            $table->string('serviceImage2');
            $table->string('serviceImage3');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('advantage');
    }
};