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
        Schema::create('c_r_u_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('date')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('main_image')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_r_u_d_s');
    }
};
