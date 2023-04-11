<?php

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
        Schema::create('orders', static function (Blueprint $table) {
            $table->id();
            $table->char('nano_id', 8)->unique();
            $table->foreignIdFor(Vendor::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->string('category');
            $table->unsignedInteger('goods_number')->nullable();
            $table->unsignedInteger('goods_weight')->nullable();
            $table->text('description')->nullable();
            $table->string('address_from');
            $table->string('address_to');
            $table->date('pickup_at');
            $table->date('delivery_at');
            $table->string('pickup_location_type');
            $table->string('delivery_location_type');
            $table->json('options');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
