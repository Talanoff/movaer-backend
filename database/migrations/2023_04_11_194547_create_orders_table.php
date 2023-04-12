<?php

use App\Models\Country;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->tinyInteger('status');
            $table->tinyInteger('category');
            $table->unsignedSmallInteger('goods_number')->nullable();
            $table->unsignedSmallInteger('goods_weight')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(Country::class, 'country_from_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignIdFor(Country::class, 'country_to_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('address_from');
            $table->string('address_to');
            $table->date('pickup_at');
            $table->date('delivery_at');
            $table->tinyInteger('pickup_location_type');
            $table->tinyInteger('delivery_location_type');
            $table->json('details');
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