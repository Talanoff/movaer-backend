<?php

use App\Enums\WishCategoryEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wishes', static function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->enum('category', array_column(WishCategoryEnum::cases(), 'value'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishes');
    }
};
