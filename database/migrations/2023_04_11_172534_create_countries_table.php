<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', static function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->char('alpha2', 2);
            $table->char('alpha3', 3);
            $table->boolean('is_visible')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
