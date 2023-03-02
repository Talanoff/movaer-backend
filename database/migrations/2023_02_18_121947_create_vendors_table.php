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
        Schema::create('vendors', static function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('name');
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->string('scope');
            $table->string('employees');
            $table->double('rating', 2, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
