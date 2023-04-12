<?php

use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
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
        Schema::create('chat_rooms', static function (Blueprint $table) {
            $table->id();
            $table->char('nano_id', 12)->unique();
            $table->string('title');
            $table->foreignIdFor(Order::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Vendor::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
