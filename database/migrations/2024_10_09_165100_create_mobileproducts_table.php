<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobileproducts', function (Blueprint $table) {
            $table->id();
            $table->string('Brand');
            $table->string('Model');
            $table->string('Version');
            $table->string('Processor');
            $table->string('RAM');
            $table->string('ROM');
            $table->string('Color');
            $table->string('Display_Size');
            $table->string('Camera_f');
            $table->string('Camera_b');
            $table->string('Battery');
            $table->string('Price');
            $table->string('Gallery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobileproducts');
    }
};